<?php

namespace App\Entities;

use App\Http\Requests\SubscribeRequest;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * @package App\Entities
 * @property int id
 * @property string email
 * @property string token
 */
class Subscription extends Model
{
    const TOKEN_LENGTH = 100;

    public static function add(SubscribeRequest $request): Subscription
    {
        $subscription = new static();
        $subscription->email = $request->get('email');
        return $subscription;
    }

    public function generateToken(): void
    {
        $this->token = str_random(self::TOKEN_LENGTH);
    }

    public function saveSubscription(): void
    {
        $this->save();
    }

}
