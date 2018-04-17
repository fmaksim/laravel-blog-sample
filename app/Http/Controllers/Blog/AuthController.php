<?php

namespace App\Http\Controllers\Blog;

use App\Entities\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;

use App\Services\AuthService;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {

        User::add($request->all());
        return redirect()->route('home');

    }

    public function registerForm()
    {

        return view('blog.register');

    }

    public function login(LoginRequest $request)
    {

        if ($this->authService->login($request))
            return redirect()->route('home');

        return redirect()->back()->with('status', config('app.unsuccess_login_message'));

    }

    public function loginForm()
    {

        return view('blog.login');

    }


}
