<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('parent.profilesettings');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        if ($request->hasFile('image')) {
            // delete old image
            $old_image = public_path('profile_images/'.$user->image);
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $image = $request->file('image');
            $name = $request->name.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/profile_images');
            $image->move($destinationPath, $name);
            $user->image = $name;
        }
        
        $user->save();
        return back()->with('success','Profile updated successfully');
    }
    public function update_password(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = Auth::user();
        if (password_verify($request->oldpassword, $user->password)) {

            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with('successpasschange','Password updated successfully');
        }else{

            return back()->with('errorpasschange','Old password is incorrect');
        }
    }
}
