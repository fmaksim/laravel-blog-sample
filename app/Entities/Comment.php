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

    public function toggleStatus($value)
    {
        return ($value === null) ? $this->disallow() : $this->allow();
    }

    private function allow()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->save();
    }

    private function disallow()
    {
        $this->status = self::STATUS_HIDDEN;
        $this->save();
    }

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function author()
    {
        return $this->hasOne(User::class);
    }
}
