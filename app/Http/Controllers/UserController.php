<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
    //    $users = User::where('id', '!=', 1)->orderBy('name')->paginate(10);
    //    return view ('user.index', compact('users'));

    $search = request('search');
    if ($search){
        $users = User::where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orwhere('email', 'like', '%' . $search . '%');
        })
            ->orderBy('name')
            ->where('id', '!=', 1)
            ->paginate(20)
            ->withQueryString();
    } else {
        $users = User::where('id', '!=', 1)
         ->orderBy('name')
         ->paginate(10);
    }
    return view('user.index', compact('users'));
    }
}