<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        return view('admin.usermanager.users', ['user' => $user, 'users' => $users]);

    }

    public function show($id)
    {
        $user = Auth::user();
        $users = User::all();
        return view('admin.usermanager.users', ['user' => $user, 'users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        $newuser = new User();
        return view('admin.usermanager.createuser', ['newuser' => $newuser, 'roles' => $roles]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Assign the "user" role to the new user
        $user->assignRole($request->input('role'));
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }



    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('success', 'User deleted successfully.');
    }

    public function trashedUsers()
    {
        $user = Auth::user();
        $trashedUsers = User::onlyTrashed()->get();
        return view('admin.usermanager.trashed', ['trashedUsers' => $trashedUsers, 'user' => $user]);
    }

    public function restoreUser($userId)
    {
        $user = User::withTrashed()->find($userId);

        if ($user) {
            $user->restore();
            return redirect()->route('users.index')->with('success', 'User restored successfully.');
        } else {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.usermanager.edituser', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            // Add more validation rules as needed
        ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        $user->syncRoles([$request->input('role')]); // Update user role

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


}

