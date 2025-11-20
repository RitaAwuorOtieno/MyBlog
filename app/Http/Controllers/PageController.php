<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PageController extends Controller
{
    public function home()
    {
        $posts = Post::latest()->take(3)->get();
        return view('home', compact('posts'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
