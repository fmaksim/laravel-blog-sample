<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Entities\Post;
use App\Entities\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Services\PostService;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->getAll();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\PostCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {

        try {
            $this->postService->create($request);
            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Post was not created');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postService->getById($id);

        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.posts.edit', compact('categories', 'tags', 'post'));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \App\Http\Requests\PostUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $this->postService->update($request, $id);
            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Post was not updated');
        }
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->postService->remove($id);
            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Post was not deleted!');
        }
    }
}
