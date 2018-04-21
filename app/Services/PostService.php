<?php
/**
 * Created by PhpStorm.
 * User: famin
 * Date: 21.4.18
 * Time: 16.41
 */

namespace App\Services;


use App\Entities\Post;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;

class PostService
{

    public function create(PostCreateRequest $request): Post
    {
        $post = Post::create($request->all());
        $post = $this->save($post, $request);

        return $post;
    }

    public function update(PostUpdateRequest $request, $id): Post
    {
        $post = $this->getById($id);
        $post->fill($request->all());
        $post = $this->save($post, $request);

        return $post;
    }

    public function remove($id): void
    {
        $post = $this->getById($id);
        $post->delete();
    }

    public function getAll()
    {
        return Post::all();
    }

    public function getById($id): Post
    {
        return Post::findOrFail($id);
    }

    public function getBySlug($slug): Post
    {
        return Post::where("slug", $slug)->firstOrFail();
    }

    public function getActiveComments(Post $post)
    {
        $comments = $post
            ->comments()
            ->where('status', Post::STATUS_ACTIVE)
            ->get();

        return $comments;
    }

    private function save(Post $post, $request): Post
    {
        $post->uploadImage($request->file('image'));

        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));

        $post->toggleFeatured($request->get('is_featured'));
        $post->toggleStatus($request->get('status'));

        return $post;
    }

}