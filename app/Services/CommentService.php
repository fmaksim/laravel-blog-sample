<?php

namespace App\Services;

use App\Entities\Comment;
use App\Http\Requests\PostCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentService
{

    public function getAll()
    {
        return Comment::all();
    }

    public function getById($id): Comment
    {
        return Comment::findOrFail($id);
    }

    public function create(PostCommentRequest $request): Comment
    {

        $comment = new Comment();
        $comment->text = $request->get('text');
        $comment->post_id = $request->get('post_id');
        $comment->user_id = Auth::user()->id;
        $comment->status = Comment::STATUS_HIDDEN;

        $comment->save();
        return $comment;

    }

    public function toggleStatus($id, $status)
    {
        return ($status === Comment::STATUS_TEXT_HIDDEN) ? $this->disallow($id) : $this->allow($id);
    }

    private function allow($id)
    {
        $comment = $this->getById($id);
        $comment->status = Comment::STATUS_ACTIVE;
        $comment->save();
    }

    private function disallow($id)
    {
        $comment = $this->getById($id);
        $comment->status = Comment::STATUS_HIDDEN;
        $comment->save();
    }

}