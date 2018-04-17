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

    public static function add($fields)
    {

        $user = new static();
        $user->fill($fields);

        $user->generatePassword($fields["password"]);
        $user->save();

        return $user;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->generatePassword($fields["password"]);
        $this->save();
    }

    public function remove()
    {
        $this->deleteAvatar($this->avatar);
        $this->delete();
    }

    public function getAvatar()
    {
        return self::UPLOAD_PATH . $this->avatar;
    }

    public function uploadAvatar($avatar)
    {
        if($avatar === null) {return;}

        $this->deleteAvatar($avatar);
        $filename = str_random(16) .'.'. $avatar->extension();
        $avatar->storeAs(self::UPLOAD_PATH, $filename);

        $this->avatar = $filename;
        $this->save();
    }

    public function toggleAdmin($value)
    {
        return ($value === null) ? $this->makeNormal() : $this->makeAdmin();
    }

    public function toggleBan($value)
    {
        return ($value === null) ? $this->unban() : $this->ban();
    }

    public function generatePassword($password)
    {
        return ($password === null) ? '' : $this->password = bcrypt($password);
    }

    private function ban()
    {
        $this->status = self::STATUS_BANNED;
        $this->save();
    }

    private function unban()
    {
        $this->status = self::STATUS_NORMAL;
        $this->save();
    }

    private function makeAdmin()
    {
        $this->is_admin = self::STATUS_ADMIN;
        $this->save();
    }

    private function makeNormal()
    {
        $this->is_admin = self::STATUS_USER;
        $this->save();
    }


    private function deleteAvatar($avatar)
    {
        if($avatar === null) {return;}
        Storage::delete(self::UPLOAD_PATH . $avatar);
    }
}
