<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return App\Models\Message
     */
    public function index($userId)
    {
        $messages = User::find($userId)->messages;

        $data = [
          'messages' => $messages
        ];

        return 
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

        Message::create([
            'user_id' => $userId,
            'message' => $request->message,
            'author_messsage_user_id' => 1
        ]);

        return response()->json([
            'message' => 'Message send.'
        ], 200);
    }

    /**
     * Update the last resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId, $messageId)
    {
        $request->validate([
            'message' => 'required',
            'id' => 'required',
        ]);

        if (User::find($userId)->messages->last()->id == $messageId) {
            $message = Message::find($messageId);
            $message->message = $request->message;
            $message->save();

            return response()->json([
                'message' => 'Message successfully updated.'
            ], 200);
        }

        return response()->json([
            'message' => 'Message not updated.'
        ], 401);
    }
}
