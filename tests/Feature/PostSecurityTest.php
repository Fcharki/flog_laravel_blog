<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_body_is_sanitized_when_saved(): void
    {
        $post = Post::factory()->create([
            'body' => '<p>Hello</p><script>alert(1)</script><img src="x" onerror="alert(1)">',
        ]);

        $body = $post->fresh()->body;

        $this->assertStringContainsString('<p>Hello</p>', $body);
        $this->assertStringNotContainsString('<script', $body);
        $this->assertStringNotContainsString('onerror', $body);
    }

    public function test_user_cannot_edit_another_users_post(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = Post::factory()->for($owner)->create();

        $response = $this->actingAs($otherUser)->get(route('posts.edit', $post));

        $response->assertForbidden();
    }

    public function test_search_query_must_not_exceed_the_maximum_length(): void
    {
        $response = $this->get(route('search', ['query' => str_repeat('a', 101)]));

        $response->assertSessionHasErrors('query');
    }
}
