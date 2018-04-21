<?php

namespace App\Services;


use App\Entities\Category;
use App\Http\Requests\CategoryCreateRequest;

class CategoryService
{

    public function create(CategoryCreateRequest $request): Category
    {
        return Category::create($request->all());
    }

    public function update(CategoryCreateRequest $request, $id): bool
    {
        $category = $this->getById($id);
        return $category->update($request->all());
    }

    public function remove($id): void
    {
        $category = $this->getById($id);
        $category->delete();
    }

    public function getAll()
    {
        return Category::all();
    }

    public function getById($id): Category
    {
        return Category::findOrFail($id);
    }

    public function getBySlug($slug): Category
    {
        return Category::where("slug", $slug)
            ->firstOrFail();
    }

}