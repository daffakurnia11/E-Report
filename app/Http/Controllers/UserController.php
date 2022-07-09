<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', [
            'users'     => User::all(),
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email:dns|unique:users',
            'phone'     => 'required|numeric|min:10',
            'password'  => 'required|min:4',
            'repeat'    => 'required|min:4|same:password',
            'roles'     => 'required'
        ]);

        $firstNumber = substr($validated['phone'], 0, 1);
        if ($firstNumber === '0') {
            $validated['phone'] = $validated['phone'];
        } else {
            $validated['phone'] = '0' . $validated['phone'];
        }

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect('/user')->with('message', 'User created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'user'      => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->id == $user->id) {
            return back()->with('message', 'Access Denied');
        }
        $validated = $request->validate([
            'roles'     => 'required',
        ]);
        $user->update($validated);

        return redirect('/user')->with('message', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id == $user->id) {
            return back()->with('message', 'Access Denied');
        }
        $user->delete();

        return back()->with('message', 'User deleted');
    }

    public function resetpass(User $user)
    {
        $newpass = Hash::make('password');
        $user->update([
            'password' => $newpass
        ]);
        return redirect('/user')->with('message', 'Password reset!');
    }
}
