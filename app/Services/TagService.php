<?php

namespace App\Services;


use App\Entities\Tag;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;

class TagService
{

    public function create(TagCreateRequest $request): Tag
    {
        return Tag::create($request->all());
    }

    public function update(TagUpdateRequest $request, $id): bool
    {
        $tag = $this->getById($id);
        return $tag->update($request->all());
    }

    public function remove($id): void
    {
        $tag = $this->getById($id);
        $tag->delete();
    }

    public function getAll()
    {
        return Tag::all();
    }

    public function getKeyValueList()
    {
        return Tag::pluck('title', 'id')->all();
    }

    public function getBySlug($slug)
    {
        return Tag::where("slug", $slug)->firstOrFail();
    }

    public function getById($id)
    {
        return Tag::findOrFail($id);
    }

}