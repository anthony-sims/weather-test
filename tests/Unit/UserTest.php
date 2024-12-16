<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Tests that a user can be created.
     */
    public function test_user_can_be_created(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $name = fake()->name;
        $email = fake()->email;
        $password = fake()->password;
        
        $response = $this->postJson('/api/users', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
        ]);
    }

    /**
     * Assert that a user can be retrieved.
     */
    public function test_user_can_be_retrieved(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $user = User::factory()->create();
        Session::start();
        $response = $this->getJson('/api/users/' . $user->id);

        $response->assertStatus(200);
    }
}
