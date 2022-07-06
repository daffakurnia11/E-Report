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
        if (auth()->user()->username == $user->username) {
            return back()->with('message', 'Access Denied');
        }
        $validated = $request->validate([
            'roles'     => 'required',
        ]);
        if ($request->verify) {
            $validated['verified_at'] = Carbon::now();
        }
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
        if (auth()->user()->username == $user->username) {
            return back()->with('message', 'Access Denied');
        }
        $user->delete();

        return back()->with('message', 'User deleted');
    }

    public function resetpass(User $user)
    {
        $newpass = Hash::make($user->email);
        $user->update([
            'password' => $newpass
        ]);
        return redirect('/user')->with('message', 'Password reset!');
    }
}
