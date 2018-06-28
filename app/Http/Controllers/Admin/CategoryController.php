<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->getAll();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \App\Http\Requests\CategoryCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        try {
            $this->categoryService->create($request);
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Category was not created!');
        }
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryService->getById($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \App\Http\Requests\CategoryUpdateRequest $request
     * @param  int                                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            $this->categoryService->update($request, $id);
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Category was not updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->categoryService->remove($id);
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Category was not removed!');
        }
    }
}
