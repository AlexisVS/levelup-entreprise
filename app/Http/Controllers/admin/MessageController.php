<?php

namespace App\Http\Controllers\admin;

use App\Events\SendMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

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
            SendMessageEvent::dispatch($user->messages, $user->id);
            event(new SendMessageEvent($user->messages, $user->id));
        }

        $data = [
            'users' => $users
        ];

        return view('pages.messenger', $data);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

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

        SendMessageEvent::dispatch($message, $userId);
        event(new SendMessageEvent($message, $userId));

        return redirect()->back();
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
