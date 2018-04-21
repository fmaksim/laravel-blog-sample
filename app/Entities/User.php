<?php

namespace App\Entities;

use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

/**
 * Class User
 * @package App\Entities
 * @property int id
 * @property string name
 * @property string email
 * @property string avatar
 * @property string password
 * @property int is_admin
 * @property int status
 */

class User extends Authenticatable
{
    use Notifiable;

    const UPLOAD_PATH = "/uploads/";

    const STATUS_ADMIN = 1;
    const STATUS_USER = 0;

    const STATUS_BANNED = 1;
    const STATUS_NORMAL = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add(): User
    {

        $user = new static();
        return $user;
    }

    public function getAvatar()
    {
        return self::UPLOAD_PATH . $this->avatar;
    }

}
