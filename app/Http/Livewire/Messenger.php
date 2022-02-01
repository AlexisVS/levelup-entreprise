<?php

namespace App\Http\Livewire;

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
        $this->users->find($message->user_id)->messages->push($message);
    }

    public function render()
    {
        $data = [
            'users' => $this->users
        ];
        return view('livewire.messenger', $data);
    }
}
