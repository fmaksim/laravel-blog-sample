<?php

namespace App\Http\Controllers\Blog;

use App\Entities\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(config('app.posts_per_page'));
        return view('blog.home', compact('posts'));
    }
}
