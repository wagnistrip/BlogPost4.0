<?php

namespace App\Http\Controllers\Frontend\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(6);
        $categories = BlogCategory::all();

        return view('frontend.blogs.index', compact('blogs', 'categories'));
    }
    public function show($slug)
    { 
        $categories = BlogCategory::all();
        $blog = Blog::where('slug', $slug)->with('category', 'user', 'comments', 'images')->firstOrFail();
        
     
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
                            ->where('id', '!=', $blog->id)
                            ->latest()
                            ->take(5)
                            ->get();
        

        $recentPosts = Blog::latest()->take(3)->get();
    
        return view('frontend.blogs.detail', compact('blog', 'categories', 'relatedBlogs', 'recentPosts'));
    }
    
    public function categoryBlogs($slug)
   { 
        $categories = BlogCategory::all();
        return view('frontend.blogs.detail', compact('blog','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
