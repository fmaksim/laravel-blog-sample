<?php

namespace App\Http\Controllers\Blog;

use App\Entities\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        return view('blog.home', compact('posts'));
    }
}
