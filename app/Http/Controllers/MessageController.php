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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = auth()->user()->messages;

        return response()->json([
            'data' => [
                'messages' => $messages,
            ],
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex($userId)
    {
        $messages = User::find($userId)->messages;

        return response()->json([
            'data' => [
                'messages' => $messages,
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
            'message' => 'required'
        ]);

        Message::create([
            'user_id' => auth()->user()->id,
            'message' => $request->message,
            'author_messsage_user_id' => auth()->user()->id
        ]);

        return response()->json([
            'message' => 'Message send.'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminStore(Request $request, $userId)
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
    public function update(Request $request, $messageId)
    {
        $request->validate([
            'message' => 'required',
            'id' => 'required',
        ]);

        if (auth()->user()->messages->last()->id == $messageId) {
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

    /**
     * Update the last resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminUpdate(Request $request, $userId, $messageId)
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
