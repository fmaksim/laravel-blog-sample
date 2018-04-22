<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->commentService->getAll();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Update the specified comment status in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus($id, $status)
    {
        try {
            $this->commentService->toggleStatus($id, $status);
            return redirect()->route('comments.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Comment was not updated!');
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