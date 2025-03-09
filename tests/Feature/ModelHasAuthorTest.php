<?php

namespace Rulr\Authored\Tests\Feature;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Rulr\Authored\Tests\Models\Post;
use Rulr\Authored\Tests\TestCase;
use Rulr\Authored\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Model;

class ModelHasAuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sets_created_by_field_on_creation()
    {
        // Create a user
        $user = $this->createUser();

        // Act as that user
        Auth::login($user);

        // Create a post
        $post = Post::create(['title' => 'First Post']);

        // Assertions
        $this->assertEquals($user->id, $post->created_by);
        $this->assertNull($post->updated_by);

        $this->assertInstanceOf(User::class, $post->creator);
    }

    /** @test */
    public function it_sets_updated_by_field_on_update()
    {
        // Create a user
        $user = $this->createUser();
        Auth::login($user);

        // Create a post
        $post = Post::create(['title' => 'First Post']);

        // Another user updates the post
        $newUser = $this->createUser();
        Auth::login($newUser);
        $post->update(['title' => 'Updated Post']);

        // Assertions
        $this->assertEquals($user->id, $post->created_by);
        $this->assertEquals($newUser->id, $post->updated_by);

        $this->assertInstanceOf(User::class, $post->creator);
        $this->assertInstanceOf(User::class, $post->updater);
    }
}

