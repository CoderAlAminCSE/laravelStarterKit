<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // get user info
    public function profile()
    {
        $authUser = Auth::user();
        return view('backend.user.profile.index', compact('authUser'));
    }


    // update user info
    public function profileUpdate(Request $request)
    {
        try {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $authUser = User::where('id', Auth::user()->id)->first();
            $authUser->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->hasFile('image')) {
                if ($authUser->image) {
                    Storage::delete('public/' . $authUser->image);
                }
                $filePath = $request->file('image')->storeAs('backend/profile', Str::uuid() . '.' .  $request->file('image')->getClientOriginalName(), 'public');
                $authUser->image = $filePath;
                $authUser->save();
            }
            session()->flash('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong');
        }
        return back();
    }
}
