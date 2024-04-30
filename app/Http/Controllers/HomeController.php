<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with(['comments', 'user'])->paginate(20);
        return view('home', compact('posts'));
    }

    public function show(Request $request, Post $post)
    {
        // $post = Post::with(['comments', 'user'])->whereSlug($slug)->firstOrFail();
        return view('post', compact('post'));
    }

    public function about(Request $request)
    {
        return view('about');
    }

    public function contact(Request $request)
    {
        return view('contact');
    }
}
