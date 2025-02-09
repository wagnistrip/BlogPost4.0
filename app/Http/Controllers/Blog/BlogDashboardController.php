<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\BlogImage;
use App\Models\BlogCategory;

class BlogDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function dashboard(Request $request)
    {

          $blogs = Blog::orderBy('id', 'desc')->paginate(10);
          return view('blogs.dashboard.dashboard',compact('blogs'));
    }

    public function addBlog(Request $request)
    {
        $categories  = BlogCategory::get();
        return view('blogs.dashboard.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading'           => 'required|string|max:255',
            'sub_heading'       => 'nullable|string|max:255',
            'categories'        => 'nullable',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'status'            => 'required|boolean',
            'images.*'          => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog                    = new Blog();
        $blog->user_id           = Auth::id();
        $blog->title             = $request->heading;
        $blog->sub_title         = $request->sub_heading;
        $blog->short_description = $request->short_description;
        $blog->description       = $request->description;
        $blog->status            = $request->status;
        $blog->category_id       = $request->categories;
        $blog->slug              = $this->generateUniqueSlug($request['heading']);
        $blog->save();

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path     = $image->storeAs('uploads/blogs', $filename, 'public');

                BlogImage::create([
                    'blog_id'    => $blog->id,
                    'image_path' => $path,
                    'image_name' => $filename,
                ]);
            }
        }

        return redirect()->route('blog.dashboard')->with('success', 'Blog created successfully!');
    }
    public function edit($id)
    {
         $blog       = Blog::find($id);
         $categories  = BlogCategory::get();

         return view('blogs.dashboard.edit',compact('blog','categories'));
    }
    public function BlogUpdate(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'heading'           => 'required|string|max:255',
            'sub_heading'       => 'nullable|string|max:255',
            'categories'        => 'nullable',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'status'            => 'required|boolean',
            'images.*'          => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog = Blog::findOrFail($id);

        $blog->update([
            'title'             => $request->heading,
            'sub_title'         => $request->sub_heading,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'status'            => $request->status,
            'category_id'       => $request->categories,
            'slug'              => $this->generateUniqueSlug($request->heading,$id),
        ]);

        if ($request->hasFile('images')) {
            $existingImages = BlogImage::where('blog_id', $blog->id)->get();

            foreach ($request->file('images') as $key => $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path     = $image->storeAs('uploads/blogs', $filename, 'public');

                BlogImage::updateOrCreate(
                    ['id' => $existingImages[$key]->id ?? null],
                    [
                        'blog_id'    => $blog->id,
                        'image_path' => $path,
                        'image_name' => $filename,
                    ]
                );
            }
        }

        return redirect()->route('blog.dashboard')->with('success', 'Blog updated successfully!');

    }
    public function destroy($id)
    {

          $blogs = Blog::find($id);
          $blogs->delete();
          return redirect()->route('blog.dashboard')->with('success', 'Blog Deleted successfully!');
    }

    public function logout()
    {
          Auth::guard('admin')->logout();
          return redirect()->route('login');
    }

    private function generateUniqueSlug($title)
    {
        $slug  = Str::slug($title);
        $count = Blog::where('slug', 'LIKE', "$slug%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function deleteImage(Request $request)
    {

            $image = BlogImage::find($request['id']);

            if (!$image) {
                return response()->json(['success' => false, 'message' => 'Image not found.']);
            }

            // Delete the image from storage
            Storage::delete('public/' . $image->image_path);

            // Remove from database
            $image->delete();

            return response()->json(['success' => true]);
    }

}
