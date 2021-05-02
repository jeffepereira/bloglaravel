<?php

namespace Jeffpereira\Blog\Model;

use Illuminate\Database\Eloquent\Model;
use Jeffpereira\Blog\Traits\UsesUuid;

class Comment extends Model
{
    use UsesUuid;
}
