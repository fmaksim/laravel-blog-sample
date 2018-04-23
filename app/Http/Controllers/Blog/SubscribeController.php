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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Subscribe error, please try later!');
        }
    }

    public function verify($token)
    {

    }
}
