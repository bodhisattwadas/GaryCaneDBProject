<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        return view('profile',[
            'user' => auth()->user()
        ]);
    }
    //Update profile password
    public function update(Request $request)
    {
        $request->validate([
           'current_password' => 'required',
           'password' => 'required|string|min:8',
        ]);
        //check if current password is correct
        if (!\Hash::check($request->current_password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }else{
            //update password
            $user = auth()->user();
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('/profile')->with('success', 'Password updated successfully.');
        }
    }
}
