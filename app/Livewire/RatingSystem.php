<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\PostRating;

class RatingSystem extends Component
{
    public $post;
    public $rating = 0;
    public $userRating;

    public function mount($post)
    {
        $this->post = $post;
        if (Auth::check()) {
            $this->userRating = $this->post->ratings()->where('user_id', Auth::id())->first();
            $this->rating = $this->userRating ? $this->userRating->rating : 0;
        }
    }

    public function rate($value)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->rating = $value;

        if ($this->userRating) {
            $this->userRating->update(['rating' => $value]);
        } else {
            $this->userRating = PostRating::create([
                'user_id' => Auth::id(),
                'post_id' => $this->post->id,
                'rating' => $value
            ]);
        }

        $this->emit('ratingUpdated');
    }

    public function render()
    {
        return view('livewire.rating-system', [
            'averageRating' => $this->post->ratings()->avg('rating'),
            'totalRatings' => $this->post->ratings()->count()
        ]);
    }
}
