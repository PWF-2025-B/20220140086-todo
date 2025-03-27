<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', Auth::id())->get();
        dd($todos);
        return view('todo.index');
    }
    public function create()
    {
        return view('create.index');
    }
    public function edit()
    {
        return view('edit.index');
    }
}

