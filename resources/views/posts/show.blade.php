@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
    <div class="prose mb-6">{!! nl2br(e($post->content)) !!}</div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-2">Buy access / Tip author</h3>

        <form id="pay-form">
            @csrf
            <label>Phone</label>
            <input name="phone" id="phone" value="{{ auth()->user()->phone ?? '' }}" class="w-full border p-2 mb-2" placeholder="07XXXXXXXX" required>
            <label>Amount (KES)</label>
            <input name="amount" id="amount" value="50" class="w-full border p-2 mb-2" required>
            <button id="pay-btn" type="button" class="bg-indigo-600 text-white px-4 py-2 rounded">Pay with M-Pesa</button>
        </form>

        <div id="pay-result" class="mt-4"></div>
    </div>
</div>

<script>
document.getElementById('pay-btn').addEventListener('click', async function(){
    const phone = document.getElementById('phone').value;
    const amount = document.getElementById('amount').value;
    const token = document.querySelector('input[name="_token"]').value;

    const res = await fetch("{{ route('mpesa.stk', $post->id) }}", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
        body: JSON.stringify({ phone, amount })
    });

    const data = await res.json();
    document.getElementById('pay-result').innerText = JSON.stringify(data);
});
</script>
@endsection
