<?php

namespace App\Entities;

use App\Entities\Category;
use App\Entities\Tag;
use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * Class Post
 * @package App\Entities
 * @property int id
 * @property string content
 * @property string title
 * @property string description
 * @property string slug
 * @property string image
 * @property int category_id
 * @property int user_id
 * @property int views
 * @property int status
 * @property int is_featured
 * @property date date
 *
 */

class Post extends Model
{
    use Sluggable;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    const IS_FEATURED = 1;
    const IS_STANDART = 0;

    const NO_CATEGORY_TEXT = 'Без категории';
    const NO_TAGS_TEXT = 'Нет тегов';

    const UPLOAD_PATH = "/uploads/";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'date', 'description'
    ];

    public static function create($fields)
    {
        $post = new static();
        $post->fill($fields);
        $post->user_id = 1;

        $post->save();
        return $post;

    }

    public function edit($fields)
    {

        $this->fill($fields);
        $this->save();

    }

    public function remove()
    {
        $this->deleteImage($this->image);
        $this->delete();

    }

    public function uploadImage($image)
    {
        if($image === null) {return;}

        $this->deleteImage($image);
        $filename = str_random(16) .'.'. $image->extension();
        $image->storeAs(self::UPLOAD_PATH, $filename);

        $this->image = $filename;
        $this->save();

    }

    private function deleteImage($image)
    {
        if($image === null) {return;}
        Storage::delete(self::UPLOAD_PATH . $image);
    }

    public function getImage()
    {
        return self::UPLOAD_PATH . $this->image;
    }

    public function setCategory($id)
    {
        if($id === null) {return;}

        $category = Category::find($id);
        $this->category()->associate($category);
    }

    public function setTags($ids)
    {
        if($ids === null) {return;}
        $this->tags()->sync($ids);
    }


    public function toggleStatus($status)
    {
        return ($status === null) ? $this->setActive() : $this->setDraft();
    }

    private function setDraft()
    {
        $this->status = self::STATUS_DRAFT;
        $this->save();
    }

    private function setActive()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->save();
    }


    public function toggleFeatured($status)
    {
        return ($status === null) ? $this->setStandart() : $this->setFeatured();
    }

    private function setFeatured()
    {
        $this->is_featured = self::IS_FEATURED;
        $this->save();
    }

    private function setStandart()
    {
        $this->is_featured = self::IS_STANDART;
        $this->save();
    }

    public function getCategoryTitle()
    {
        return $this->category ? $this->category->title : self::NO_CATEGORY_TEXT;
    }

    public function getTagsTitles()
    {
        $tags = $this->tags->pluck('title')->all();
        return $tags ? implode(', ', $tags) : self::NO_TAGS_TEXT;
    }

    public function getDateAttribute($value)
    {
        $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
        $this->attributes['date'] = $date;
    }

    public function setDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
        $this->attributes['date'] = $date;
    }

    public function getDate()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['date'])->format('F d, Y');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    public function hasPrevious()
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    public function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    public function previous()
    {
        $postId = $this->hasPrevious();
        return self::find($postId);
    }

    public function next()
    {
        $postId = $this->hasNext();
        return self::find($postId);
    }

    public function related()
    {
        return self::all()->except($this->id);
    }



    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
