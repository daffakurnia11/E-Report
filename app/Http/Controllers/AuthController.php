<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin()
    {
        return view('signin');
    }

    public function authorization(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required',
            'password'  => 'required|min:4',
        ]);
        if (Auth::attempt($credentials)) {
            return redirect('/')->with('message', "Sign In Success");
        }
        return back()->with('message', 'Sign In Failed');
    }

    public function signup()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required',
            'username'  => 'required|unique:users|alpha-dash',
            'email'     => 'required|email:dns|unique:users',
            'phone'     => 'required|numeric|min:10',
            'password'  => 'required|min:4',
            'repeat'    => 'required|min:4|same:password'
        ]);

        $firstNumber = substr($validated['phone'], 0, 1);
        if ($firstNumber === '0') {
            $validated['phone'] = $validated['phone'];
        } else {
            $validated['phone'] = '0' . $validated['phone'];
        }

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect('/signin')->with('message', 'Sign Up Success');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/signin')->with('message', 'Logout Success');
    }
}
