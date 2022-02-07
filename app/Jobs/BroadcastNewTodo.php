<?php

namespace App\Jobs;

use App\Events\TodoReceivedEvent;
use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BroadcastNewTodo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $todo;
    public $userId;
    public $tries = 3;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Todo $todo, $userId)
    {
        $this->todo = $todo;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(new TodoReceivedEvent($this->todo, $this->userId));
    }
}
