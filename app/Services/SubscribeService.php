<?php
/**
 * Created by PhpStorm.
 * User: famin
 * Date: 23.4.18
 * Time: 23.36
 */

namespace App\Services;


use App\Entities\Subscription;
use App\Http\Requests\SubscribeRequest;
use App\Mail\VerifySubscription;
use Illuminate\Support\Facades\Mail;

class SubscribeService
{

    public function subscribe(SubscribeRequest $request)
    {
        $subscription = Subscription::add($request);
        $subscription->generateToken();
        $subscription->saveSubscription();
        //send mail
        Mail::to($request
            ->get('email'))
            ->send(new VerifySubscription($subscription->token));
    }

}