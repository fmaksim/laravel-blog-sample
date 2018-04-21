<?php

namespace App\Http\Controllers\Blog;

use App\Entities\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function show($slug)
    {
        $tag = $this->tagService->getBySlug($slug);
        $posts = $tag->posts()->paginate(config('app.posts_per_page'));

        return view('blog.list', compact('posts'));
    }
}
