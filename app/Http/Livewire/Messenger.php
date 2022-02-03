<?php

namespace App\Http\Livewire;

use App\Jobs\BroadcastMessengerJob;
use App\Jobs\SendMessageReceivedJob;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Messenger extends Component
{
    protected $listeners = ['echo:messages,SendMessageEvent' => 'updateMessages'];
    public Collection $users;

    // public $userId;
    public $message;

    protected $rules = [
        'message' => 'required',
    ];

    public function mount(Collection $users)
    {
        $this->users = $users;
    }

    // public function updating($users)
    // {
    //     $this->users = User::all()->skip(1);
    // }

    public function updateMessages($socketMessage)
    {
        if ($this->users->find($socketMessage['data']['message']['user_id'])->messages->find($socketMessage['data']['message']['id']) == false) {
            $newMessage = new Message($socketMessage['data']['message']);
            $this->users->find($socketMessage['data']['message']['user_id'])->messages->push($newMessage);
        }
    }

    public function render()
    {
        $data = [
            'users' => $this->users
        ];
        return view('livewire.messenger', $data);
    }

    public function submit($userId)
    {
        $this->validate();

        $message = Message::create([
            'user_id' => $userId,
            'message' => $this->message,
            'author_messsage_user_id' => 1
        ]);

        BroadcastMessengerJob::dispatch($message, $userId);
        SendMessageReceivedJob::dispatch($message, $userId);

        // $this->users = User::all()->skip(1);
    }
}
