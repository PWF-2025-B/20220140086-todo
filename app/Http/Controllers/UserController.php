<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Tampilkan daftar pengguna dengan pencarian dan pagination
    public function index()
    {
        $search = request('search');

        $users = User::with('todos')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->where('id', '!=', 1)
            ->orderBy('name')
            ->paginate(10);

        return view('user.index', compact('users'));
    }

    // Jadikan user sebagai admin
    public function makeadmin(User $user)
    {
        $user->timestamps = false;
        $user->is_admin = true;
        $user->save();

        return back()->with('success', 'Make admin successfully!');
    }

    // Hapus hak admin dari user (selain ID 1)
    public function removeadmin(User $user)
    {
        if ($user->id != 1) {
            $user->timestamps = false;
            $user->is_admin = false;
            $user->save();

            return back()->with('success', 'Remove admin successfully!');
        }

        return redirect()->route('user.index');
    }

    // Tampilkan detail user berdasarkan ID
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    // Hapus user (selain ID 1)
    public function destroy(User $user)
    {
        if ($user->id != 1) {
            $user->delete();
            return back()->with('success', 'Delete user successfully!');
        }

        return redirect()->route('user.index')->with('danger', 'Delete user failed!');
    }
}