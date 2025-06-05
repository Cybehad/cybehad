<?php
// app/Http/Livewire/NotificationPreferences.php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationPreferences extends Component
{
    public $receiveNotifications;

    public function mount()
    {
        $this->receiveNotifications = Auth::user()->receive_notifications;
    }

    public function updatedReceiveNotifications($value)
    {
        Auth::user()->update(['receive_notifications' => $value]);
        $this->dispatchBrowserEvent('preferences-updated');
    }

    public function render()
    {
        return view('livewire.notification-preferences');
    }
}
