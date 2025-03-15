<?php

namespace Tests\Feature;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostLikeTest extends TestCase
{
    /**
     * A basic feature test example.
     */ use RefreshDatabase;

    public function test_user_can_like_and_unlike_a_post()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a post
        $post = Post::factory()->create();

        // Act as the user
        $this->actingAs($user);

        // Like the post
        $response = $this->post(route('posts.like', $post));

        // Assert the post was liked
        $response->assertStatus(200);
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        // Unlike the post
        $response = $this->post(route('posts.like', $post));

        // Assert the post was unliked
        $response->assertStatus(200);
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
    }
}
