<?php

namespace Jeffpereira\Blog\Traits;

use Jeffpereira\Blog\Model\Comment;

trait HasComments
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'author');
    }
}
