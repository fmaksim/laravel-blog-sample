<?php

namespace App\Http\Controllers\Blog;

use App\Entities\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where("slug", "=", $slug)->firstOrFail();
        $posts = $category->posts()->paginate(config('app.posts_per_page'));

        return view('blog.list', compact('posts'));


    }
}
