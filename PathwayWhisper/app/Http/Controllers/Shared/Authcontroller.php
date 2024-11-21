<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Authcontroller extends Controller
{
    public function login(Request $request)
    {
        // validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attempt login
        if (auth()->attempt($request->only('email', 'password'))) {
            // if successfull, redirect to their intended location
            if(auth()->user()->role=='admin')
            {
                return redirect()->intended('/admin');
            }
            return redirect()->intended('/');
        }

        // if unsuccessfull, redirect back with the form data
        return back()->with('error', 'Invalid login details');
    }

    public function signup(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required | confirmed',
            'password_confirmation' => 'required'
        ]);
        // create a user and save image
        $user = new User;
        $user->name = $request->name;
        $user->role = 'user';
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $nameinimage = $request->name;
        // finish the space in the name
        $nameinimage = str_replace(' ', '', $nameinimage);
        $imageName = $nameinimage.time().'.'.$request->image->extension();
        $request->image->move(public_path('profile_images/'), $imageName);
        $user->image = $imageName;
        $user->save();
        // sign the user in
        Auth::login($user);
        return redirect()->intended('/');
    }
    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    // api/getmentor/info/{id}
    public function getmentorinfo($id)
    {
        $mentor = User::where('id', $id)->first();
        return response()->json($mentor);
    }

}
