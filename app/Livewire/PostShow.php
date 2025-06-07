<?php

namespace App\Livewire;

use App\CommentStatusEnum;
use App\Models\Comment;
use App\Models\FeaturedProduct;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostRating;
use App\Models\SavedPost;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostShow extends Component
{
    public $post;
    public $commentContent = '';
    public $rating = 0;
    public $isSaved = false;

    protected $listeners = ['commentAdded' => '$refresh'];

    protected $rules = [
        'commentContent' => 'required|min:3|max:1000',
    ];
    protected $rateLimiting = [
        'addComment' => '1,5', // 1 attempt every 5 seconds
    ];
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->checkIfSaved();

        //Track view
        $post->recordView(request()->ip(), Auth::id());
    }

    public function checkIfSaved()
    {
        if (Auth::check()) {
            $this->isSaved = SavedPost::where('user_id', Auth::id())
                ->where('post_id', $this->post->id)
                ->exists();
        }
    }
    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (!$comment) return;

        if (
            Auth::check() &&
            ($comment->user_id === Auth::id() || $this->post->user_id === Auth::id())
        ) {
            $comment->delete();
            $this->post->refresh();
            $this->dispatch('commentAdded');
        }
    }
    public function addComment()
    {
        $this->validate([
            'commentContent' => ['required', 'min:3']
        ]);
        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'content' => $this->commentContent,
            'status' => CommentStatusEnum::Approved->value,
        ]);
        $this->commentContent = '';
        // $this->emit('commentAdded');
    }
    public function ratePost()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $rating = PostRating::where('user_id', Auth::id())
            ->where('post_id', $this->post->id)
            ->first();
        if ($rating) {
            $rating->update(['rating', $this->rating]);
        } else {
            PostRating::create([
                'user_id' => Auth::id(),
                'post_id' => $this->post->id,
                'rating' => $this->rating
            ]);
        }
        // $this->rating = '';
        // $this->emit('ratingAdded');
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $like = PostLike::where('user_id', Auth::id())
            ->where('post_id', $this->post->id)
            ->first();
        if ($like) {
            $like->delete();
        } else {
            PostLike::create([
                'user_id' => Auth::id(),
                'post_id' => $this->post->id,
            ]);
        }
        // $this->emit('likeToggled');
    }
    public function toggleSave()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isSaved) {
            SavedPost::where('user_id', Auth::id())
                ->where('post_id', $this->post->id)
                ->delete();
        } else {
            SavedPost::create([
                'user_id' => Auth::id(),
                'post_id' => $this->post->id
            ]);
            $this->isSaved = true;
        }
    }

    public function render()
    {
        return view('livewire.post-show', [
            'comments' => $this->post->comments()->with('user')->approved()->latest()->get(),
            'relatedPosts' => $this->post->relatedPosts()->published()->limit(3)->get(),
            'averageRating' => $this->post->ratings()->avg('rating'),
            'likeCount' => $this->post->likes()->count(),
            'userRating' => Auth::check() ? $this->post->ratings()->where('user_id', Auth::id())->first() : null,
            'hasLiked' => Auth::check() ? $this->post->likes()->where('user_id', Auth::id())->exists() : false,
        ])
            ->layout('components.layouts.custom');
    }
}
