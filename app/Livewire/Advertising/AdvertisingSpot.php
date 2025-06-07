<?php

namespace App\Livewire\Advertising;

use Livewire\Component;
use App\Models\AdvertisingSpot;

class AdvertisingSpot extends Component
{
    public $location;

    public function mount($location)
    {
        $this->location = $location;
    }

    public function render()
    {
        $spot = AdvertisingSpot::where('location', $this->location)
            ->where('is_active', true)
            ->where(function($query) {
                $query->whereNull('start_date')
                      ->orWhere('start_date', '<=', now());
            })
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
            })
            ->inRandomOrder()
            ->first();

        return view('livewire.advertising.advertising-spot', [
            'spot' => $spot,
        ]);
    }
}
