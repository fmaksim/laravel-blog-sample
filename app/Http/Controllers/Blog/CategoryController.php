<?php

namespace App\Http\Controllers\Blog;

use App\Entities\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function show($slug)
    {
        $category = $this->categoryService->getBySlug($slug);
        $posts = $category->posts()->paginate(config('app.posts_per_page'));

        return view('blog.list', compact('posts'));


    }
}
