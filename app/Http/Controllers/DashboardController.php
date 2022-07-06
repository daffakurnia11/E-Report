<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request, User $user)
    {
        if ($user->username != $request->username) {
            $usernameValidator = 'required|unique:users';
        } else {
            $usernameValidator = 'required';
        }

        if ($user->email != $request->email) {
            $emailValidator = 'required|email:dns|unique:users';
        } else {
            $emailValidator = 'required|email:dns';
        }

        $validate = $request->validate([
            'name'      => 'required',
            'username'  => $usernameValidator,
            'email'     => $emailValidator
        ]);

        $user->update($validate);
        return back()->with('message', 'Profile updated');
    }

    public function changepass(Request $request, User $user)
    {
        $validated = $request->validate([
            'oldpass'   => 'required|current_password',
            'password'  => 'required|min:4|different:oldpass',
            'repeat'    => 'required|min:4|same:password'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user->update($validated);
        return back()->with('message', 'Password changed');
    }
}
