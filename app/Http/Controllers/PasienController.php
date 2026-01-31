<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pasien.index', compact('users'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:admin,pasien,doktor',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pasien.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, User $pasien)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $pasien->id,
            'role' => 'required|in:admin,pasien,doktor',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $pasien->update($data);

        return redirect()->route('pasien.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'User berhasil dihapus');
    }
}
