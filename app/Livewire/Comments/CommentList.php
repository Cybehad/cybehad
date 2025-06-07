<?php

namespace App\Livewire\Comments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comment;

class CommentList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $postFilter = '';
    public $perPage = 10;

    public function approveComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->status = 'approved';
        $comment->save();
        session()->flash('message', 'Comment approved successfully.');
    }

    public function markAsSpam($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->status = 'spam';
        $comment->save();
        session()->flash('message', 'Comment marked as spam.');
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        session()->flash('message', 'Comment deleted successfully.');
    }

    public function render()
    {
        return view('livewire.comments.comment-list', [
            'comments' => Comment::query()
                ->when($this->search, function ($query) {
                    $query->where('content', 'like', '%'.$this->search.'%')
                          ->orWhere('author_name', 'like', '%'.$this->search.'%')
                          ->orWhere('author_email', 'like', '%'.$this->search.'%');
                })
                ->when($this->statusFilter, function ($query) {
                    $query->where('status', $this->statusFilter);
                })
                ->when($this->postFilter, function ($query) {
                    $query->where('post_id', $this->postFilter);
                })
                ->with(['post', 'user', 'parent'])
                ->paginate($this->perPage),
            'statuses' => ['approved', 'pending', 'spam'],
        ]);
    }
}
