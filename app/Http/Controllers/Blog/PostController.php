<?php

namespace App\Http\Controllers\Blog;

use App\Entities\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function show($slug)
    {
        $post = Post::where("slug", $slug)->firstOrFail();
        $activeComments = $this->postService->getActiveComments($post);

        return view("blog.post", compact('post', 'activeComments'));
    }
}
