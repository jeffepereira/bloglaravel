<?php

namespace Jeffpereira\Blog\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Jeffpereira\Blog\Traits\UsesUuid;

class Comment extends Model
{
    use UsesUuid;

    protected $fillable = ['post_id'];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Get the owning commentable model.
     */
    public function author(): MorphTo
    {
        return $this->morphTo();
    }



    public function active($active = true)
    {
        $this->active = $active;
        $this->save();
    }
}
