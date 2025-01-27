<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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
               'heading' => 'required',
               'sub_heading' => 'required',
               'name' => 'required',
               'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
          ]);

          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator);
          }

          $blog                         = new Blog;
          $blog->title                  = $request->heading;
          $blog->sub_title              = $request->sub_heading;
          $blog->name                   = $request->name;
          $blog->short_description      = $request->short_description;
          $blog->description            = $request->description;
          $blog->admin_id               = Auth::id();

          $blogImage                   = new BlogImage();

          if ($request->hasFile('image')) {

              $file      = $request->file('image');
              $extension = $file->getClientOriginalExtension();
              $filename  = time() . '.' . $extension;
              $file->move(public_path('blog/'), $filename);
              $blog->image = $filename;
          }

          // Set the status
          $blog->status = $request->status;

          // Save the blog
          $blog->save();

          return redirect()->route('blog.dashboard')->with('success', 'Blog created successfully');
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
               'image'       => 'image|mimes:jpeg,png,jpg,gif,svg' // Image not required during update
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
               // Delete old image if exists
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
