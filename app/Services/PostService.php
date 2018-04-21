<?php
/**
 * Created by PhpStorm.
 * User: famin
 * Date: 21.4.18
 * Time: 16.41
 */

namespace App\Services;


use App\Entities\Post;

class PostService
{

    public function getActiveComments(Post $post)
    {
        $comments = $post
            ->comments()
            ->where('status', Post::STATUS_ACTIVE)
            ->get();

        return $comments;
    }

}