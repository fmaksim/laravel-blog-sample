<?php

namespace App\Http\Controllers\Blog;

use App\Entities\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function show($slug)
    {
        $tag = Tag::where("slug", $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(config('app.posts_per_page'));

        return view('blog.list', compact('posts'));
    }
}
