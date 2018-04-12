<?php

namespace App\Http\Controllers\Blog;

use App\Entities\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::where("slug", $slug)->firstOrFail();
        return view("blog.post", compact('post'));
    }
}
