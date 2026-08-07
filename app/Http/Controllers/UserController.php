<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of system users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role_name', 'like', "%{$search}%")
                  ->orWhere('user_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role_name', $request->role);
        }

        $users = $query->orderBy('id', 'desc')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_name' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_name' => $request->role_name,
            'status' => $request->status ?? 'Active',
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'New User Account Registered Successfully!');
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role_name' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_name' => $request->role_name,
            'status' => $request->status ?? $user->status,
            'phone_number' => $request->phone_number ?? $user->phone_number,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User Details Updated Successfully!');
    }

    /**
     * Toggle Active / Inactive status of a user.
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = ($user->status === 'Inactive') ? 'Active' : 'Inactive';
        $user->save();

        return redirect()->back()->with('success', "User Status Updated to {$user->status}!");
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting self if logged in
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account while logged in!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User Account Removed Successfully!');
    }
}
