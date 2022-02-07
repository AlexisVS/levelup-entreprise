<?php

namespace App\Http\Controllers\admin;

use App\Events\MessageReceivedEvent;
use App\Events\SendMessageEvent;
use App\Http\Controllers\Controller;
use App\Jobs\BroadcastMessengerJob;
use App\Jobs\SendMessageReceivedJob;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource of the all users.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all()->skip(1);

        foreach ($users as $user) {
            $user->contacts = $user->contacts;
            $user->messages = $user->messages;
        }

        $data = [
            'users' => $users
        ];

        return view('pages.messenger', $data);
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
            'message' => 'required'
        ]);

        $message = Message::create([
            'user_id' => $userId,
            'message' => $request->message,
            'author_messsage_user_id' => 1
        ]);

        BroadcastMessengerJob::dispatch($message, $userId);
        SendMessageReceivedJob::dispatch($message, $userId);


        return redirect()->back();
    }
}
