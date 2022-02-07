<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\BroadcastNewTodo;
use App\Jobs\SendMailDailyUncompletedTasksUsers;
use App\Jobs\SendMailNewTodoCreatedJob;
use App\Mail\NewTodoReceived;
use App\Mail\UncompletedTodoTasks;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->skip(1);

        foreach ($users as $user) {
            $user->contacts = $user->contacts;
            $user->todos = $user->todolists->todos;
        };

        $data = [
            'users' => $users,
        ];

        return view('pages.todolist', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $userId)
    {
        $request->validate([
            'text' => 'required'
        ]);

        $todo = Todo::create([
            'todolist_id' => User::find($userId)->todolists->id,
            'text' => $request->text,
            'status' => 'open',
        ]);

        SendMailNewTodoCreatedJob::dispatch(User::find($userId));
        BroadcastNewTodo::dispatch($todo, $userId);

        return redirect()->back();
    }
}
