<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\UserUpdateRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index()
    {
        $user = Auth::user();
        return view('blog.profile', compact('user'));
    }

    public function update(UserUpdateRequest $request)
    {
        try {
            $this->profileService->update($request);
            return redirect()
                ->back()
                ->with('success', config('app.success_update_profile_message'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', config('app.unsuccess_update_profile_message'));
        }
    }
}
