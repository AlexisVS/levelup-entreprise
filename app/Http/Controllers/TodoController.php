<?php

namespace App\Http\Controllers;

use App\Jobs\BroadcastNewTodo;
use App\Jobs\SendMailNewTodoCreatedJob;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = auth()->user()->todolists->todos;

        return response()->json([
            'data' => [
                'todos' => $todo,
            ],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $store = Todo::create([
            'todolist_id' => auth()->user()->todolists->id,
            'text' => $request->text,
            'status' => 'open'
        ]);

        // BroadcastNewTodo::dispatch($store, '1');

        return response()->json([
            'message' => 'Todo successfully created',
            'data' => [
                'todo' => $store
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        Todo::destroy($todo);

        return response()->json([
            'message' => 'Todo successfully created',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->text = $request->text;
        $todo->save();

        return response()->json([
            'message' => 'Todo successfully updated',
        ], 200);
    }

    /**
     * done the specified resource in storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function done($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->status = 'done';
        $todo->save();

        return response()->json([
            'message' => 'Todo successfully updated',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        Todo::destroy($todo);

        return response()->json([
            'message' => 'Todo successfully destroyed.'
        ], 200);
    }
}
