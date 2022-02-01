<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Messenger extends Component
{
    protected $listeners = ['echo:messages,SendMessageEvent' => 'updateMessages'];
    public Collection $users;

    public function mount(Collection $users)
    {
        $this->users = $users;
    }

    public function updateMessages($message)
    {
        if ($this->users->find($message['data']['message']['user_id'])->messages->find($message['data']['message']['id']) == false) {
            # code...
            $newMessage = new Message($message['data']['message']);
            $this->users->find($message['data']['message']['user_id'])->messages->push($newMessage);
        }
    }

    public function render()
    {
        $data = [
            'users' => $this->users
        ];
        return view('livewire.messenger', $data);
    }
}
