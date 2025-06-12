<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show list of all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the create user form
    public function create()
    {
        return view('users.create');
    }


    // Handle form submission and create new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
  

    // Show a single user's details
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the edit form
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Handle the update
   public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email,' . $user->id,
        'role' => 'required|string',
    ]);

    // Track original values
    $hasChanges = false;

    if ($user->name !== $request->name) {
        $user->name = $request->name;
        $hasChanges = true;
    }

    if ($user->email !== $request->email) {
        $user->email = $request->email;
        $hasChanges = true;
    }

    if ($user->role !== $request->role) {
        $user->role = $request->role;
        $hasChanges = true;
    }

    // If password filled, update it too
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
        $hasChanges = true;
    }

    if ($hasChanges) {
        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    return redirect()->route('users.index')->with('info', 'No changes were made.');
}

    // Delete the user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

}
