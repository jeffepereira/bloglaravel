<?php

namespace Jeffpereira\Blog\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jeffpereira\Blog\Model\Comment;
use Jeffpereira\Blog\Model\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @test
     */
    public function a_project_can_has_one_or_more_comments()
    {
        $post = factory(Post::class)->create();

        factory(Comment::class, 5)->create(['post_id' => $post->id]);

        $this->assertEquals(5, $post->refresh()->comments->count());
    }

    /**
     *
     * @test
     */
    public function while_delete_post_delete_all_comments_of_post()
    {
        $post = factory(Post::class)->create();

        factory(Comment::class, 5)->create(['post_id' => $post->id]);

        $this->assertEquals(5, $post->refresh()->comments->count());

        Post::first()->forceDelete();

        $this->assertNull(Post::first());

        $this->assertEquals(0, Comment::all()->count());
    }
}
