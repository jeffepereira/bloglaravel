<?php

namespace Jeffpereira\Blog\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jeffpereira\Blog\Model\Comment;
use Jeffpereira\Blog\Model\Post;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @test
     */
    public function a_comment_must_start_with_inactive()
    {
        $author = factory(User::class)->create();

        $author2 = factory(User::class)->create();

        $author2->comments()->saveMany(factory(Comment::class, 5)->make(['post_id' => $author->posts()->create()->id]));

        Comment::all()->each(function ($comment) {
            $this->assertFalse($comment->active);
        });
    }


    /**
     *
     * @test
     */
    public function it_test_method_active_comment()
    {
        $author = factory(User::class)->create();

        $author2 = factory(User::class)->create();

        $comment = $author2->comments()->save(factory(Comment::class)->make(['post_id' => $author->posts()->create()->id]));

        $this->assertFalse($comment->refresh()->active);

        $comment->active();

        $this->assertTrue($comment->refresh()->active);

        $comment->active(false);

        $this->assertFalse($comment->refresh()->active);
    }


    /**
     *
     * @test
     */
    public function test_morph_type_comment()
    {
        $author = factory(User::class)->create();

        $author2 = factory(User::class)->create();

        $comment = $author2->comments()->save(factory(Comment::class)->make(['post_id' => $author->posts()->create()->id]));

        $this->assertInstanceOf(User::class, $comment->author);

        $author2 = factory(Admin::class)->create();

        $comment = $author2->comments()->save(factory(Comment::class)->make(['post_id' => $author->posts()->create()->id]));

        $this->assertInstanceOf(Admin::class, $comment->author);
    }


    /**
     *
     * @test
     */
    public function test_data_comment()
    {
        $comment = factory(Comment::class)->create(['body' => "Test of body comment"]);

        $this->assertEquals("Test of body comment", $comment->body);
    }


    /**
     *
     * @test
     */
    public function test_liked_in_comment()
    {
        $comment = factory(Comment::class)->create(['body' => "Test of body comment"]);

        $this->assertEquals(0, $comment->likes);
    }
}
