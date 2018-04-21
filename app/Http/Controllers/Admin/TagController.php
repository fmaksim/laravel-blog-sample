<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Tag;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Controllers\Controller;
use App\Services\TagService;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * Display a listing of the tags.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tagService->getAll();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param  \App\Http\Requests\TagCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagCreateRequest $request)
    {
        try {
            $this->tagService->create($request);
            return redirect()->route('tags.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tag was not created!');
        }

    }

    /**
     * Show the form for editing the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tag = $this->tagService->getById($id);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified tag in storage.
     *
     * @param  \App\Http\Requests\TagUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $id)
    {

        try {
            $this->tagService->update($request, $id);
            return redirect()->route('tags.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tag was not updated!');
        }
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->tagService->remove($id);
            return redirect()->route('tags.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tag was not deleted!');
        }
    }
}
