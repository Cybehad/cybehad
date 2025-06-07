<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\NewsletterSubscription;
use Illuminate\Support\Str;

class NewsletterSubscription extends Component
{
    public $email;
    public $subscribed = false;

    protected $rules = [
        'email' => 'required|email|unique:newsletter_subscriptions,email',
    ];

    public function subscribe()
    {
        $this->validate();

        NewsletterSubscription::create([
            'email' => $this->email,
            'token' => Str::random(32),
            'is_active' => true,
        ]);

        $this->subscribed = true;
        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.frontend.newsletter-subscription');
    }
}
