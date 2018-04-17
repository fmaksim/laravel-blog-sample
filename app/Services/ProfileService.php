<?php
/**
 * Created by PhpStorm.
 * User: famin
 * Date: 17.4.18
 * Time: 20.14
 */

namespace App\Services;


use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class ProfileService
{

    public function update($request)
    {
        try {

            $user = Auth::user();
            $user->fill($request->all());
            $user->generatePassword($request->get("password"));
            $user->uploadAvatar($request->file("avatar"));
            $user->save();
            return true;

        } catch (Exception $e) {
            return false;
        }

    }

}