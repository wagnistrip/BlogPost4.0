<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
        return view('blogs.Auth.login');
    }
    public function authentiCation(Request $request)
    {
        $validatedData = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);
    
        $user = Admin::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            
            Auth::guard('admin')->login($user, $request->has('remember'));
            

            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')
                             ->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }
    public function logout(Request $request)
    {

        if (Auth::guard('admin')->check()) 
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }
    }   
 
}
