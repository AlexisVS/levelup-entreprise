<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notification extends Component
{

    protected $listeners = ['echo-private:App.Models.User.1,MessageReceivedEvent' => 'addNotification'];
    public $notifications;

    public function render()
    {
        if ($this->notifications != null) {
            $data = [
                'notifications' => $this->notifications,
                'mdr' => 'mdr'
            ];
            return view('livewire.notification', $data);
        } else {
            $data = [
                'mdr' => 'mdr'
            ];
            return view('livewire.notification', $data);
        }
    }

    public function mount()
    {
        // $this->notifications = collect([]);
    }

    public function addNotification($data)
    {
        // dd($data);
        if ($this->notifications == null) {
            $this->notifications = collect([$data]);
        }
        $this->notifications = collect([$this->notifications])->push($data);
    }
}
