<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $admin = Admin::find(Auth::id());
         return view('admin.setting.my-account',compact('admin'));
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
    public function show(string $id)
    {
        //
    }

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
    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'firstname' => 'required|string|max:255',
        'lastname'  => 'required|string|max:255',
        'email'     => 'required|email|max:255',
        'phone'     => 'required|string|max:15',
        'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate the avatar file
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Find the admin by ID
    $admin = Admin::find($id);

    if (!$admin) {
        return redirect()->back()->with('error', 'Admin not found.');
    }

    // Update admin details
    $admin->name     = $request->firstname;
    $admin->lastName = $request->lastname;
    $admin->email    = $request->email;
    $admin->phone    = $request->phone;

    // Handle existing image deletion if needed
    if ($admin->image && Storage::exists('public/admin/profilePick/' . $admin->image)) {
        Storage::delete('public/admin/profilePick/' . $admin->image);
    }

    // Handle new avatar upload
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = 'admin/profilePick/' . $avatarName;

            $avatar->move(public_path('admin/profilePick'), $avatarName);
            $admin->avtar = $avatarPath; 
        }

        // Save the admin details
        $admin->save();

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
