<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UncompletedTodoTasks extends Mailable
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
        $this->todos = $user->todolists->todos->where('status', '=', 'open');
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
            'todos' => $this->todos,
        ];

        return $this
            ->from(env("MAIL_USERNAME"))
            ->markdown('mail.uncompleted-todo-tasks', $data);
    }
}
