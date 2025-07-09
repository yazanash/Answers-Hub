<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showUserManagement()
    {
        $roles = Role::all();
        $users = User::role(['admin', 'editor'])->get();

        return view('users.index', compact('roles', 'users'));
    }

    public function setUserRole(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles($request->role);

        return redirect()->back()->with('success', 'Role updated successfully.');
    }
}
