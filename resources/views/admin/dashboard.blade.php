@extends('admin.layout')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-xl font-semibold">Total Posts</h3>
        <p class="text-3xl font-bold text-indigo-600">{{ $postsCount }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-xl font-semibold">Payments</h3>
        <p class="text-3xl font-bold text-green-600">{{ $paymentsCount }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-xl font-semibold">Messages</h3>
        <p class="text-3xl font-bold text-blue-600">{{ $messagesCount }}</p>
    </div>
</div>
@endsection
