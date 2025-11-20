<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'post_id','phone','mpesa_checkout_request_id','mpesa_merchant_request_id',
        'receipt_number','status','amount','raw_response'
    ];

    protected $casts = [
        'raw_response' => 'array',
    ];

    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }
}
