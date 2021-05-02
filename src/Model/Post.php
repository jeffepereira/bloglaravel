<?php

namespace Jeffpereira\Blog\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Jeffpereira\Blog\Traits\UsesUuid;

class Post extends Model
{
    use UsesUuid;

    /**
     * Get the owning commentable model.
     */
    public function author(): MorphTo
    {
        return $this->morphTo();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
