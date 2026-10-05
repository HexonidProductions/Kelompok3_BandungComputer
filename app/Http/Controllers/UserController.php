<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user dengan pencarian dan filter role.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role'); 

        $users = User::when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($role, function ($query, $role) {
                // Filter hanya berlaku jika nilai bukan 'All'
                if ($role !== 'All') {
                    return $query->where('role', $role);
                }
            })
            ->latest()
            ->paginate(11)
            ->withQueryString();

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Menyimpan data user baru (+ Add User).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:tb_users,email',
            'password'     => 'required|string|min:8',
            'phone_number' => 'nullable|string|max:20',
            'address'      => 'nullable|string',
            'role'         => 'required|in:Admin,Customer',
        ]);

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
            'role'         => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }

    /**
     * Memperbarui data user.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:tb_users,email,' . $user->id,
            'password'     => 'nullable|string|min:8',
            'phone_number' => 'nullable|string|max:20',
            'address'      => 'nullable|string',
            'role'         => 'required|in:Admin,Customer',
        ]);

        $data = [
            'name'         => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
            'role'         => $request->role,
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Menghapus data user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}