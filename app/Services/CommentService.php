<?php

namespace App\Services;

use App\Entities\Comment;
use App\Http\Requests\PostCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentService
{

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

}