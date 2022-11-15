<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Requests\Admin\BlogRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.blogs.index');
        }

        $blogs = Blog::query();

        return Blog::dataTable($blogs);
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(BlogRequest $request)
    {
        $input = $request->validated();
        $blog = Blog::create($input);
        $blog->saveTranslations($input);
        $blog->addAttachment($input['thumbnail']??null, 'thumbnail');
        $blog->addAttachment($input['images']??[], 'images');

        return $this->jsonSuccess('Blog created successfully', [
            'redirect' => route('admin.blogs.index')
        ]);
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $input = $request->validated();
        $blog->update($input);
        $blog->saveTranslations($input);
        $blog->addAttachment($input['thumbnail']??[], 'thumbnail');
        $blog->addAttachment($input['images']??[], 'images');

        return $this->jsonSuccess('Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return $this->jsonSuccess('Blog deleted successfully');
    }
}
