<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App\Entities
 * @property int id
 * @property int status
 * @property int post_id
 * @property int user_id
 * @property text text
 */
class Comment extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_HIDDEN = 0;

    const STATUS_TEXT_HIDDEN = 'hidden';
    const STATUS_TEXT_ACTIVE = 'active';

    public function isActive()
    {
        if ($this->status === self::STATUS_ACTIVE) {
            return true;
        } else {
            return false;
        }
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
