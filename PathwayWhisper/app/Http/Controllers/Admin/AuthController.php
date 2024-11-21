<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function admins(){
        $admins = User::where('role','admin')->get();
        return view('Admin.admins',compact('admins'));
    }
    public function create(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
            'password'=>'required|min:5|max:12|confirmed',
            'password_confirmation'=>'required|min:5|max:12'
        ]);
        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role="Admin";
        $nameinimage = $request->name;
        // finish the space in the name
        $nameinimage = str_replace(' ', '', $nameinimage);
        $imageName = $nameinimage.time().'.'.$request->image->extension();
        
        $admin->image = $imageName;
        $admin->password = Hash::make($request->password);
        $save = $admin->save();
        $request->image->move(public_path('profile_images/'), $imageName);
        if($save){
            return back()->with('success','New Admin has been successfully added to the database');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }


    }
    public function delete($id){
        $admin = User::find($id);
        // if admin is logged in
        if(auth()->user()->id == $id){
            return back()->with('error','You cannot delete yourself');
        }
        if(!$admin){
            return back()->with('fail','Admin not found');
        }
        $admin->delete();
        return redirect()->back()->with('success','Admin Deleted Successfully');
    }
    public function postlogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);
        $creds = $request->only('email','password');
        if(Auth::attempt($creds)){
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('login')->with('error','Incorrect Credentials');
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
