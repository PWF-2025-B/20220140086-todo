<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;  // Jangan lupa import ini
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())
            ->orderBy('is_done', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        $todosCompleted = Todo::where('user_id', auth()->id())
            ->where('is_done', true)
            ->count();

        return view('todo.index', compact('todos', 'todosCompleted'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('todo.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Todo::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('todo.index')
            ->with('success', 'Todo created successfully!');
    }

    public function complete(Todo $todo)
    {
        if ($todo->user_id === auth()->id()) {
            $todo->update(['is_done' => true]);

            return redirect()->route('todo.index')
                ->with('success', 'Todo completed successfully!');
        }

        return redirect()->route('todo.index')
            ->with('danger', 'You are not authorized to complete this todo!');
    }

    public function uncomplete(Todo $todo)
    {
        if ($todo->user_id === auth()->id()) {
            $todo->update(['is_done' => false]);

            return redirect()->route('todo.index')
                ->with('success', 'Todo uncompleted successfully!');
        }

        return redirect()->route('todo.index')
            ->with('danger', 'You are not authorized to uncomplete this todo!');
    }

    public function edit(Todo $todo)
    {
        if ($todo->user_id === auth()->id()) {
            $categories = Category::where('user_id', auth()->id())->get();

            return view('todo.edit', compact('todo', 'categories'));
        }

        return redirect()->route('todo.index')
            ->with('danger', 'You are not authorized to edit this todo!');
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($todo->user_id === auth()->id()) {
            $todo->update([
                'title' => ucfirst($request->title),
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('todo.index')
                ->with('success', 'Todo updated successfully!');
        }

        return redirect()->route('todo.index')
            ->with('danger', 'You are not authorized to update this todo!');
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id === auth()->id()) {
            $todo->delete();

            return redirect()->route('todo.index')
                ->with('success', 'Todo deleted successfully!');
        }

        return redirect()->route('todo.index')
            ->with('danger', 'You are not authorized to delete this todo!');
    }

    public function destroyCompleted()
    {
        Todo::where('user_id', auth()->id())
            ->where('is_done', true)
            ->delete();

        return redirect()->route('todo.index')
            ->with('success', 'All completed todos deleted successfully!');
    }
}