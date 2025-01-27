<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);
        
        return view('blogs.dashboard.dashboard',compact('blogs'));
    }
    /* dashboard index page end code */

    /* admin logout start code */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
