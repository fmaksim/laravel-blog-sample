<?php

namespace App\Http\Controllers\Blog;

use App\Entities\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {

        User::add($request->all());
        return redirect()->route('home');

    }

    public function registerForm()
    {

        return view('blog.register');

    }


}
