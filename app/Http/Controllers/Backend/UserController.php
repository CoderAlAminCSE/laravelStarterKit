<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

    // returns user list
    public function userIndex(Request $request)
    {
        try {
            if ($request->has('search') && $request->search != null) {
                $search =  $request->search;
                $roles = Role::all();
                $users = User::with('roles')->where(function ($query) use ($search) {
                    $query->where('id', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                })->paginate(10);
                return view('backend.user.index', compact('users', 'roles'));
            } else {
                $users = User::with('roles')->latest()->paginate(10);
                $roles = Role::all();
                return view('backend.user.index', compact('users', 'roles'));
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Error: ' . $e->getMessage());
            return back();
        }
    }

    // update user info
    public function userCreate(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required',
            ]);
            $user =  $user->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            $user->syncRoles($request->role);
            return redirect()->route('user.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    // update user info
    public function userUpdate(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'role' => 'required',
            ]);
            $user =  $user->findOrFail($request->input('user_id'));
            if ($user) {
                $user->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                ]);

                $user->syncRoles($request->role);
                return redirect()->route('user.index')->with('success', 'User updated successfully');
            } else {
                return redirect()->route('user.index')->with('error', 'No user found');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    //delete user
    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }

    // returns role list
    public function roleIndex(Request $request)
    {
        try {
            if ($request->has('search') && $request->search != null) {
                $search =  $request->search;
                $roles = Role::where(function ($query) use ($search) {
                    $query->where('id', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%');
                })->paginate(10);
                return view('backend.user.role.index', compact('roles'));
            } else {
                $roles = Role::latest()->paginate(10);
                return view('backend.user.role.index', compact('roles'));
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Error: ' . $e->getMessage());
            return back();
        }
    }

    // create role
    public function roleCreate()
    {
        $permissions = Permission::all();
        return view('backend.user.role.create', compact('permissions'));
    }

    // store role info
    public function roleStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name', 'regex:/^[a-zA-Z]+$/'],
        ]);
        try {
            $role = Role::create(['name' => $request->name]);
            $permissionNames = [];
            if ($request->has('permissions') && is_array($request->permissions)) {
                $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            }
            $role->syncPermissions($permissionNames);

            Session::flash('success', 'Role created successfully');
            return redirect()->route('role.index');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // edit role info
    public function roleEdit($id)
    {
        try {
            $role = Role::with('permissions')->find($id);
            $permissions = Permission::all();
            return view('backend.user.role.edit', compact('role', 'permissions'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // update role info
    public function roleUpdate(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[a-zA-Z]+$/'],
        ]);
        try {
            $role->update(['name' => $request->name]);
            $permissionNames = [];
            if ($request->has('permissions') && is_array($request->permissions)) {
                $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            }
            $role->syncPermissions($permissionNames);

            Session::flash('success', 'Role updated successfully');
            return redirect()->route('role.index');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    // return permission list
    public function permissionIndex(Request $request)
    {
        try {
            if ($request->has('search') && $request->search != null) {
                $search =  $request->search;
                $permissions = Permission::where(function ($query) use ($search) {
                    $query->where('id', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%');
                })->paginate(10);
                return view('backend.user.permission.index', compact('permissions'));
            } else {
                $permissions = Permission::latest()->paginate(10);
                return view('backend.user.permission.index', compact('permissions'));
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Error: ' . $e->getMessage());
            return back();
        }
    }
}
