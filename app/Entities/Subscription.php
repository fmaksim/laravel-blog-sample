<?php

namespace App\Entities;

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
    public static function add($email)
    {
        $subscription = new static();
        $subscription->email = $email;
        $subscription->token = str_random(100);

        $subscription->save();

    }

}
