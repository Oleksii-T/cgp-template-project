<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $page = Page::get('blog');
        $blogs = Blog::all();

        return view('blog.index', compact('page', 'blogs'));
    }

    public function show(Request $request, Blog $blog)
    {
        $page = Page::get('blog/{blog}');

        return view('blog.show', compact('page', 'blog'));
    }
}
