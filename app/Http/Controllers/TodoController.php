<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    function index()
    {
        $todos = Todo::select(['todolist', 'status', 'id'])->where('user_id', '=', Auth::id())->get();
        return view('todo.index', ['todos' => $todos]);
    }


    function create(Request $request)

    {
        $request->merge([
            "user_id" => Auth::id(),
            'status' => 'pending',
        ]);

        $data = $request->validate([
            'todolist' => 'required',
            'status' => 'required',
            'user_id' => 'required',
        ]);

        $new_todo = Todo::create($data);

        return redirect(route('todo.index'));
    }
    function update(Todo $todo, Request $request)
    {
        // $todo->update(['status' => 'completed']);
        $data = $request->validate([
            'todolist' => 'required',
        ]);

        $todo->update($data);

        return redirect(route('todo.index'));
    }

    function status(Todo  $todo, Request $request)
    {

        $data = $request->validate([
            'todo_status' => 'required',
        ]);

        $todo->update(['status' => $data['todo_status']]);

        return redirect(route('todo.index'));
    }

    function edit(Todo  $todo)
    {
        return view('todo.edit', ["todo" => $todo]);
    }
    function destroy(Todo  $todo)
    {
        $todo->delete();

        return redirect(route('todo.index'));
    }
}
