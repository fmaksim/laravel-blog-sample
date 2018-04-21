<?php
/**
 * Created by PhpStorm.
 * User: famin
 * Date: 21.4.18
 * Time: 16.41
 */

namespace App\Services;


use App\Entities\Post;
use App\Entities\Category;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostService
{

    protected $post;

    public function create(PostCreateRequest $request): Post
    {
        $this->post = Post::create();
        $this->post->fill($request->all());
        $this->post->save();

        $post = $this->save($request);

        return $post;
    }

    public function update(PostUpdateRequest $request, $id): Post
    {
        $this->post = $this->getById($id);
        $this->post->fill($request->all());
        $post = $this->save($request);

        return $post;
    }

    public function remove($id): void
    {
        $post = $this->getById($id);
        $this->deleteImage($post->image);
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

    public static function getPopular()
    {
        return Post::orderBy("views", "desc")
            ->take(Post::LIMIT_POPULAR_POSTS)
            ->get();
    }

    public static function getFeatured()
    {
        return Post::where("is_featured", Post::IS_FEATURED)
            ->take(Post::LIMIT_FEATURED_POSTS)
            ->get();
    }

    public static function getRecent()
    {
        return Post::orderBy("id", "desc")
            ->take(Post::LIMIT_RECENT_POSTS)
            ->get();
    }

    public function setCategory($id): void
    {
        if ($id === null) {
            return;
        }

        $category = Category::find($id);
        $this->post->category()->associate($category);
    }

    public function setTags($ids): void
    {
        if ($ids === null) {
            return;
        }
        $this->post->tags()->sync($ids);
    }

    public function toggleStatus($status)
    {
        return ($status === null) ? $this->setActive() : $this->setDraft();
    }

    public function toggleFeatured($status)
    {
        return ($status === null) ? $this->setStandart() : $this->setFeatured();
    }

    private function setDraft(): void
    {
        $this->post->status = Post::STATUS_DRAFT;
    }

    private function setActive(): void
    {
        $this->post->status = Post::STATUS_ACTIVE;
    }

    private function setFeatured(): void
    {
        $this->post->is_featured = Post::IS_FEATURED;
    }

    private function setStandart(): void
    {
        $this->post->is_featured = Post::IS_STANDART;
    }

    private function setAuthor(): void
    {
        $this->post->user_id = Auth::user()->id;
    }

    private function save($request): Post
    {
        $this->setAuthor();
        $this->uploadImage($request->file('image'));

        $this->setCategory($request->get('category_id'));
        $this->setTags($request->get('tags'));

        $this->toggleFeatured($request->get('is_featured'));
        $this->toggleStatus($request->get('status'));

        $this->post->save();

        return $this->post;
    }

    private function deleteImage($image): void
    {
        if ($image === null) {
            return;
        }
        Storage::delete(Post::UPLOAD_PATH . $image);
    }

    private function uploadImage($image): void
    {
        if ($image === null) {
            return;
        }

        $this->deleteImage($image);
        $filename = str_random(16) . '.' . $image->extension();
        $image->storeAs(Post::UPLOAD_PATH, $filename);

        $this->post->image = $filename;

    }

}