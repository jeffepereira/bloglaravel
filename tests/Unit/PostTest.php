<?php

namespace Jeffpereira\Blog\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jeffpereira\Blog\Model\Comment;
use Jeffpereira\Blog\Model\Post;
use Jeffpereira\Blog\Tests\User;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @test
     */
    public function a_project_can_has_one_or_more_comments()
    {
        $author = factory(User::class)->create();

        $author2 = factory(User::class)->create();

        $post = $author->posts()->create();

        $author2->comments()->saveMany(factory(Comment::class, 5)->make(['post_id' => $post->id]));

        $this->assertEquals(5, $post->refresh()->comments->count());
    }

    /**
     *
     * @test
     */
    public function while_delete_post_delete_all_comments_of_post()
    {
        $author = factory(User::class)->create();

        $author2 = factory(User::class)->create();

        $post = $author->posts()->create();

        $author2->comments()->saveMany(factory(Comment::class, 5)->make(['post_id' => $post->id]));

        $this->assertEquals(5, $post->refresh()->comments->count());

        $post->delete();

        $this->assertNull(Post::first());

        $this->assertEquals(0, Comment::all()->count());
    }


    /**
     *
     * @test
     */
    public function test_morph_type_post()
    {
        $author = factory(User::class)->create();

        $post = $author->posts()->create();

        $this->assertInstanceOf(User::class, $post->author);

        $author = factory(Admin::class)->create();

        $post = $author->posts()->create();

        $this->assertInstanceOf(Admin::class, $post->author);
    }
}
