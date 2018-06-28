<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\PostCommentRequest;
use App\Http\Controllers\Controller;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(PostCommentRequest $request)
    {

        if ($this->commentService->create($request)) {
            return redirect()
                ->back()
                ->with('success', config('app.success_creating_comment'));
        } else {
            return redirect()
                ->back()
                ->with('error', config('app.unsuccess_creating_comment'));
        }
    }
}
