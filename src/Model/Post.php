<?php

namespace Jeffpereira\Blog\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jeffpereira\Blog\Traits\UsesUuid;

class Post extends Model
{
    use UsesUuid;

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
