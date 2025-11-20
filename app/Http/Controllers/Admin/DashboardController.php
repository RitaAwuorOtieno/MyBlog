<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Payment;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'postsCount'    => Post::count(),
            'paymentsCount' => Payment::count(),
            'messagesCount' => Contact::count(),
        ]);
    }
}

