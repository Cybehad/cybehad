<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PostShow extends Component
{
    public Post $post;
    public $commentContent;
    public $replyTo;
    public $authorName;
    public $authorEmail;

    protected $rules = [
        'commentContent' => 'required|string|max:1000',
        'authorName' => 'required_if:user_id,null|string|max:100',
        'authorEmail' => 'required_if:user_id,null|email|max:100',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;

        // Record view
        $post->recordView();
    }

    public function replyToComment($commentId)
    {
        $this->replyTo = $commentId;
        $this->dispatch('scrollToCommentForm');
    }

    public function submitComment()
    {
        $this->validate();

        $commentData = [
            'content' => $this->commentContent,
            'post_id' => $this->post->id,
            'status' => 'pending',
        ];

        if (Auth::check()) {
            $commentData['user_id'] = Auth::id();
        } else {
            $commentData['author_name'] = $this->authorName;
            $commentData['author_email'] = $this->authorEmail;
        }

        if ($this->replyTo) {
            $commentData['parent_id'] = $this->replyTo;
        }

        Comment::create($commentData);

        $this->reset(['commentContent', 'replyTo', 'authorName', 'authorEmail']);
        session()->flash('message', 'Comment submitted successfully. It will be visible after approval.');
    }

    public function likePost()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->post->toggleLike();
    }

    public function render()
    {
        return view('livewire.frontend.post-show', [
            'comments' => $this->post->comments()
                ->whereNull('parent_id')
                ->where('status', 'approved')
                ->with(['replies', 'user'])
                ->get(),
            'relatedPosts' => $this->post->relatedPosts()
                ->where('status', 'published')
                ->take(3)
                ->get(),
        ]);
    }
}
