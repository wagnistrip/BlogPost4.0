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
        return view('blogs.dashboard.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog = new Blog();
        $blog->heading = $request->heading;
        $blog->sub_heading = $request->sub_heading;
        $blog->name = $request->name;
        $blog->categories = json_encode($request->categories);
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $blog->status = $request->status;
        
        $blog->save();

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads/blogs', $filename, 'public');
                $images[] = $path;
            }
            $blog->images = json_encode($images);
            $blog->save();
        }

        return redirect()->route('blog.index')->with('success', 'Blog created successfully!');
    }
    public function edit($id)
    {
     $data["blog"] = Blog::find($id);

         return view('blogs.dashboard.edit',$data);
    }
    public function BlogUpdate(Request $request)
    {
          $validator = Validator::make($request->all(), [
               'heading'     => 'required',
               'sub_heading' => 'required',
               'name'        => 'required',
               'image'       => 'image|mimes:jpeg,png,jpg,gif,svg' 
          ]);

          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator);
          }

          $updateid                 = $request->id;
          $blog                     = Blog::find($updateid);
          $blog->heading            = $request->heading;
          $blog->sub_heading        = $request->sub_heading;
          $blog->name               = $request->name;
          $blog->short_description  = $request->short_description;
          $blog->description        = $request->description;
          $blog->admin_id           = Auth::id();

          if ($request->hasFile('image')) {
           
               if ($blog->image && file_exists(public_path('blog/') . $blog->image)) {
               unlink(public_path('blog/') . $blog->image);
               }

               $file            = $request->file('image');
               $img_ext         = $file->getClientOriginalExtension();
               $filename        = 'blog-' . time() . '.' . $img_ext;
               $file->move('blog/', $filename);
               $blog->image     = $filename;
          }

          $blog->status         = $request->status;
          $blog->save();

          return redirect()->route('blog.dashboard')->with('success', 'Blog Updated successfully!');

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
}
