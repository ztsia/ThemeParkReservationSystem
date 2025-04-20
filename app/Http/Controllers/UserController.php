<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the profile edit form
    public function edit()
    {
        $user = User::find(Auth::id());
        return view('profile.editProfile', compact('user'));
    }

    // Update the user's profile
    public function update(Request $request)
{
    $user = User::find(Auth::id());

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
}


}
