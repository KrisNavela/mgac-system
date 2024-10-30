<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\branch;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $branches = branch::pluck('branch_name', 'id');

        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'branches' => $branches,

        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    public function destroy()
    {

    }
}
