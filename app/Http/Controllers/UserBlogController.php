<?php

namespace App\Http\Controllers;

use App\Models\Blog;
class UserBlogController extends Controller
{
    public function index(){
        $blogs = Blog::where('status', 0)->orderBy('updated_at','desc')->paginate(5);
        return view('users.blog.list', compact('blogs'));
    }

    public function show($slug)
    {
        $blogs = Blog::where('slug', $slug)->firstOrFail();
        return view('users.blog.show', compact('blogs'));
    }
}
