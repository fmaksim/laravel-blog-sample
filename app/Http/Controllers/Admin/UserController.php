<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAll();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \App\Http\Requests\UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

        try {
            $this->userService->create($request);
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Registration error!');
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userService->getById($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @param  int                                  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $this->userService->update($request, $id);
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Registration error!');
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->userService->remove($id);
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Deleting user error!');
        }
    }
}
