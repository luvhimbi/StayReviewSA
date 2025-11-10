<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
// Display all users
public function index()
{
$users = User::latest()->paginate(15);
return view('admin.users.index', compact('users'));
}

// Show create user form
public function create()
{
return view('admin.users.create');
}

// Store new user
public function store(Request $request)
{
$request->validate([
'firstname' => 'required|string|max:255',
'lastname' => 'required|string|max:255',
'email' => 'required|email|unique:users,email',
'role' => 'required|in:admin,user',
'password' => 'required|string|min:6|confirmed',
'popi_consent' => 'nullable|boolean',
'is_two_factor_enabled' => 'nullable|boolean',
]);

User::create([
'firstname' => $request->firstname,
'lastname' => $request->lastname,
'email' => $request->email,
'role' => $request->role,
'password' => Hash::make($request->password),
'popi_consent' => $request->has('popi_consent'),
'is_two_factor_enabled' => $request->has('is_two_factor_enabled'),
]);

return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
}

// Show edit form
public function edit(User $user)
{
return view('admin.users.edit', compact('user'));
}

// Update user
public function update(Request $request, User $user)
{
$request->validate([
'firstname' => 'required|string|max:255',
'lastname' => 'required|string|max:255',
'email' => 'required|email|unique:users,email,' . $user->id,
'role' => 'required|in:admin,user',
'password' => 'nullable|string|min:6|confirmed',
'popi_consent' => 'nullable|boolean',
'is_two_factor_enabled' => 'nullable|boolean',
]);

$user->update([
'firstname' => $request->firstname,
'lastname' => $request->lastname,
'email' => $request->email,
'role' => $request->role,
'popi_consent' => $request->has('popi_consent'),
'is_two_factor_enabled' => $request->has('is_two_factor_enabled'),
'password' => $request->password ? Hash::make($request->password) : $user->password,
]);

return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}

// Delete user
public function destroy(User $user)
{
$user->delete();
return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
}


}
