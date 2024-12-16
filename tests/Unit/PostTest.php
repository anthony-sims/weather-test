<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase as TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Assert that posts can be created.
     */
    public function test_posts_can_be_created(): void
    {
        $title = "Post Test";
        $content = "Ths is a test post";
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/posts', [
            'title' => $title,
            'content' => $content,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', [
            'title' => $title,
            'content' => $content,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Assert that posts can be retrieved.
     */
    public function test_posts_can_be_retrieved(): void
    {
        Post::factory()->count(20)->create();
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);
    }
}
