<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function create()
    {
        return view("admin.blogs.add");
    }
    public function store(Request $request)
    {
        $request->validate([
            'blog_title' => 'required|string',
            'blog_name' => 'required|string|max:255',
            'blog_description' => 'required|string|max:2048',
            'blog_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('blog_image')) {
            $blog_imagePath = $request->file('blog_image')->store('images/blogs', 'public');
        }

        Blog::create([
            'blog_title'=> $request->blog_title,
            'blog_name' => $request->blog_name,
            'blog_description' => $request->blog_description,
            'blog_image' => $blog_imagePath,
        ]);

        return redirect()->route('view.blog')->with('success', 'Blog created successfully!');
    }
    public function view()
    {
        $blogs=Blog::all();
        return view('admin.blogs.view', compact('blogs'));
    }
    public function edit(Blog $blog)
     {
         return view('admin.blogs.edit', compact('blog'));
     }

     public function update(Request $request, Blog $blog)
     {
         $request->validate([
            'blog_title' => 'required|string',
            'blog_name' => 'required|string|max:255',
            'blog_description' => 'required|string|max:2048',
            'blog_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
 
         if ($request->hasFile('blog_image')) {
            $blog_imagePath = $request->file('blog_image')->store('images/blogs', 'public');
        }
 
         $blog->update([
            'blog_title'=> $request->blog_title,
            'blog_name' => $request->blog_name,
            'blog_description' => $request->blog_description,
            'blog_image' => $blog_imagePath,
         ]);
 
         return redirect()->route('view.blog')->with('success', 'Blog updated successfully!');
     }
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('view.blog')->with('success', 'Blog deleted successfully!');
    }
}
