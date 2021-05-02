<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Jeffpereira\Blog\Model\Post;
use Faker\Generator as Faker;
use Jeffpereira\Blog\Tests\User;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'author_id' => function () {
            return factory(User::class)->create()->id;
        },
        'author_type' => function () {
            return "Jeffpereira\Blog\Tests\User";
        },
    ];
});
