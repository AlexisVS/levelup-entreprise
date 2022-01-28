<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTodoReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *
     * @var \App\Models\User
     */
    protected $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $user->contacts = $user->contacts;
        $user->todo = $user->todolists->todos->last();
        // $this->user->todo = $user->todolists->todos->last();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'user' => $this->user,
        ];

        return $this
            ->from(env("MAIL_USERNAME"))
            ->markdown('mail.new-todo-received', $data);
    }
}
