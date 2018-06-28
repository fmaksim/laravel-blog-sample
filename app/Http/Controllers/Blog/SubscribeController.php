<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\SubscribeRequest;
use App\Services\SubscribeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribeController extends Controller
{
    protected $subscribeService;

    public function __construct(SubscribeService $subscribeService)
    {
        $this->subscribeService = $subscribeService;
    }

    public function subscribe(SubscribeRequest $request)
    {
        try {
            $this->subscribeService->subscribe($request);
            return redirect()->back()->with('success', 'Success subscribe!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Subscribe error, please try later!');
        }
    }

    public function verify($token)
    {

        try {
            $this->subscribeService->verify($token);
            return redirect()->back()->with('success', 'Your subscripiton is succesfully verified!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Check verify token!');
        }
    }
}
