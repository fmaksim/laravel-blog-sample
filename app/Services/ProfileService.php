<?php
/**
 * Created by PhpStorm.
 * User: famin
 * Date: 17.4.18
 * Time: 20.14
 */

namespace App\Services;


use App\Entities\User;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProfileService
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function update(UserUpdateRequest $request): User
    {
        $id = Auth::user()->id;
        return $this->userService->update($request, $id);
    }

}