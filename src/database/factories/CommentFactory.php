<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Jeffpereira\Blog\Model\Comment;
use Jeffpereira\Blog\Tests\User;
use Faker\Generator as Faker;
use Jeffpereira\Blog\Model\Post;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'author_id' => function () {
            return factory(User::class)->create()->id;
        },
        'author_type' => function () {
            return "Jeffpereira\Blog\Tests\User";
        },
        'post_id' => function () {
            return factory(Post::class)->create()->id;
        }
    ];
});
