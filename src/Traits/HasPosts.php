<?php

namespace Jeffpereira\Blog\Traits;

use Jeffpereira\Blog\Model\Post;

trait HasPosts
{
    public function posts()
    {
        return $this->morphMany(Post::class, 'author');
    }
}
