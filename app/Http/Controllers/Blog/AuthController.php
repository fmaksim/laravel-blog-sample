<?php

namespace App\Http\Controllers\Blog;

use App\Entities\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Services\AuthService;
use App\Services\UserService;

class AuthController extends Controller
{

    protected $authService;
    protected $userService;

    public function __construct(AuthService $authService, UserService $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function register(UserCreateRequest $request)
    {
        try {
            $this->userService->create($request);
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Registration error!');
        }
    }

    public function registerForm()
    {

        return view('blog.register');

    }

    public function login(LoginRequest $request)
    {

        if ($this->authService->login($request)) {
            return redirect()->route('home');
        }

        return redirect()->back()->with('status', config('app.unsuccess_login_message'));

    }

    public function loginForm()
    {

        return view('blog.login');

    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('home');
    }


}
