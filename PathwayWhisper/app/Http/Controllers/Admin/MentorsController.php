<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MentorsController extends Controller
{
    public function mentors(){
        $mentors = User::where('role','mentor')->get();
        return view('Admin.mentors',compact('mentors'));
    }
    public function create(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
            'password'=>'required|min:5|max:12|confirmed',
            'password_confirmation'=>'required|min:5|max:12'
        ]);
        $mentor = new User();
        $mentor->name = $request->name;
        $mentor->email = $request->email;
        $mentor->role="mentor";
        $mentor->password = Hash::make($request->password);
        $nameinimage = $request->name;
        // finish the space in the name
        $nameinimage = str_replace(' ', '', $nameinimage);
        $imageName = $nameinimage.time().'.'.$request->image->extension();
        
        $mentor->image = $imageName;
        $save = $mentor->save();
        $request->image->move(public_path('profile_images/'), $imageName);
        if($save){
            return back()->with('success','New Moderator has been successfully added to the database');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }


    }
    public function delete($id){
        $mentor = User::find($id);
        // if mentor is logged in
        if(auth()->user()->id == $id){
            return back()->with('error','You cannot delete yourself');
        }
        if(!$mentor){
            return back()->with('fail','Moderator not found');
        }
        $mentor->delete();
        return redirect()->back()->with('success','Moderator Deleted Successfully');
    }
    public function postlogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);
        $creds = $request->only('email','password');
        if(Auth::attempt($creds)){
            return redirect()->route('mentor.home');
        }else{
            return redirect()->route('login')->with('error','Incorrect Credentials');
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
