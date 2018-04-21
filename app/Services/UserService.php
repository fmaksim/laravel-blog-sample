<?php

namespace App\Services;


use App\Entities\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Storage;

class UserService
{
    protected $user;

    public function create(UserCreateRequest $request): User
    {
        $this->user = User::add();
        $this->save($request);

        return $this->user;
    }

    public function update(UserUpdateRequest $request, $id): User
    {

        $this->user = $this->getById($id);
        $this->save($request);

        return $this->user;
    }

    public function remove($id): void
    {
        $this->user = $this->getById($id);
        $this->deleteAvatar($this->user->avatar);
        $this->user->delete();
    }

    public function getAll()
    {
        return User::all();
    }

    public function getById($id): User
    {
        return User::findOrFail($id);
    }

    public function toggleAdmin($value)
    {
        return ($value === null) ? $this->makeNormal() : $this->makeAdmin();
    }

    public function toggleBan($value)
    {
        return ($value === null) ? $this->unban() : $this->ban();
    }

    private function save($request): void
    {
        $this->user->fill($request->all());
        $this->generatePassword($request->get("password"));
        $this->uploadAvatar($request->file('avatar'));
        $this->user->save();
    }

    private function uploadAvatar($avatar): void
    {
        if ($avatar === null) {
            return;
        }

        $this->deleteAvatar($avatar);
        $filename = str_random(16) . '.' . $avatar->extension();
        $avatar->storeAs(User::UPLOAD_PATH, $filename);

        $this->user->avatar = $filename;

    }

    private function deleteAvatar($avatar)
    {
        if ($avatar === null) {
            return;
        }
        Storage::delete(User::UPLOAD_PATH . $avatar);
    }

    private function generatePassword($password)
    {
        return ($password === null) ? '' : $this->user->password = bcrypt($password);
    }

    private function ban()
    {
        $this->user->status = User::STATUS_BANNED;
    }

    private function unban()
    {
        $this->user->status = User::STATUS_NORMAL;
    }

    private function makeAdmin()
    {
        $this->user->is_admin = User::STATUS_ADMIN;
    }

    private function makeNormal()
    {
        $this->user->is_admin = User::STATUS_USER;
    }

}