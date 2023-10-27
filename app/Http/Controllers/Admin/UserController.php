<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        return view('admin.users', ['user' => $user, 'users' => $users]);

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'));
    }
}
