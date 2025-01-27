<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
class ChangePasswordController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
      
    }

    public function changePasswordForm()
    {
        $id         = Auth::guard('admin')->id();
        $user       = Admin::find($id);
        return view('admin.setting.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id         = Auth::guard('admin')->id();

        $this->validate($request, [
            'current_password'      => 'required',
            'new_password'          => 'required|min:8|confirmed',

        ]);

        $user                       = Admin::find($id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('changePassword.form')->with('success', 'Password changed successfully!');

        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }


    }
}
