<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MpesaController extends Controller
{
    protected function baseUrl()
    {
        return config('app.mpesa_base', env('MPESA_BASE_URL', 'https://sandbox.safaricom.co.ke'));
    }

    protected function getAccessToken()
    {
        $key = env('MPESA_CONSUMER_KEY');
        $secret = env('MPESA_CONSUMER_SECRET');
        $url = $this->baseUrl() . '/oauth/v1/generate?grant_type=client_credentials';

        $response = Http::withBasicAuth($key, $secret)
                        ->acceptJson()
                        ->get($url);

        if ($response->ok()) {
            return $response->json()['access_token'] ?? null;
        }

        Log::error('Mpesa token error: ' . $response->body());
        return null;
    }

    public function stkPush(Request $request, $postId = null)
    {
        // Validate incoming form
        $data = $request->validate([
            'phone' => 'required|string',     // format: 2547xxxxxxxx or 07xxxxxxxx (we'll normalize)
            'amount' => 'required|numeric|min:1',
        ]);

        // Normalize phone to 254...
        $phone = $this->formatPhone($data['phone']);

        // Create Payment record (pending)
        $payment = Payment::create([
            'post_id' => $postId,
            'phone' => $phone,
            'amount' => $data['amount'],
            'status' => 'pending',
        ]);

        $token = $this->getAccessToken();
        if (!$token) {
            return response()->json(['error' => 'Unable to get access token'], 500);
        }

        $timestamp = Carbon::now()->format('YmdHis');
        $shortcode = env('MPESA_SHORTCODE');
        $passkey = env('MPESA_PASSKEY');
        $password = base64_encode($shortcode . $passkey . $timestamp);

        $body = [
            "BusinessShortCode" => $shortcode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => (int)$data['amount'],
            "PartyA" => $phone,                         // customer's MSISDN
            "PartyB" => $shortcode,                     // business shortcode
            "PhoneNumber" => $phone,
            "CallBackURL" => env('MPESA_CALLBACK_URL'),
            "AccountReference" => "Post#" . ($postId ?? 'general'),
            "TransactionDesc" => "Payment for blog post",
        ];

        $response = Http::withToken($token)
            ->post($this->baseUrl() . '/mpesa/stkpush/v1/processrequest', $body);

        if ($response->successful()) {
            $resp = $response->json();

            // Save the CheckoutRequestID if present (for later matching)
            if (isset($resp['CheckoutRequestID'])) {
                $payment->mpesa_checkout_request_id = $resp['CheckoutRequestID'];
                $payment->mpesa_merchant_request_id = $resp['MerchantRequestID'] ?? null;
                $payment->save();
            }

            return response()->json($resp);
        }

        Log::error('STK Push error: ' . $response->body());
        return response()->json(['error' => 'STK Push failed', 'details' => $response->body()], 500);
    }

    // Format 07xxx or 2547xxx to 2547xxx
    protected function formatPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) == 10 && substr($phone, 0, 1) == '0') {
            return '254' . substr($phone, 1);
        }
        if (strlen($phone) == 9 && substr($phone, 0, 1) == '7') {
            return '254' . $phone;
        }
        return $phone;
    }

    // This receives the callback from Daraja
    public function callback(Request $request)
    {
        $payload = $request->all();

        // Log for debugging
        Log::info('MPESA callback: ' . json_encode($payload));

        // Daraja sends a nested JSON structure with result
        $body = $payload; // store entire body
        // Example path to CheckoutRequestID may vary; find actual path from payload
        $checkoutRequestID = data_get($payload, 'Body.stkCallback.CheckoutRequestID', null);
        $resultCode = data_get($payload, 'Body.stkCallback.ResultCode', null);
        $resultDesc = data_get($payload, 'Body.stkCallback.ResultDesc', null);

        $payment = Payment::where('mpesa_checkout_request_id', $checkoutRequestID)->first();

        if (!$payment) {
            // Optionally, try matching by merchant request id or other fields
            Log::warning("Payment not found for CheckoutRequestID: {$checkoutRequestID}");
        } else {
            if ($resultCode === 0) {
                // success: find receipt and amount
                $metadata = data_get($payload, 'Body.stkCallback.CallbackMetadata.Item', []);
                $receipt = null;
                $amount = null;
                foreach ($metadata as $item) {
                    if (isset($item['Name']) && $item['Name'] === 'MpesaReceiptNumber') {
                        $receipt = $item['Value'];
                    }
                    if (isset($item['Name']) && $item['Name'] === 'Amount') {
                        $amount = $item['Value'];
                    }
                }

                $payment->status = 'success';
                $payment->receipt_number = $receipt;
                $payment->amount = $amount ?? $payment->amount;
            } else {
                $payment->status = 'failed';
            }

            $payment->raw_response = $body;
            $payment->save();
        }

        // IMPORTANT: return 200 OK to Safaricom
        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
    }
}
