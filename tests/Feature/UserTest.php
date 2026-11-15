<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    public function test_create_user()
    {

        $this->seed();

        $json = [
            'firstName' => 'Diallo',
            'lastName' => 'Mamadou',
            'email' => 'diallo@example.com',
            'phone' => '+15140040044',
        ];

        $response = $this->postJson('/api/users/create', $json);

        $response->assertJsonFragment($json);
        $response->assertStatus(201);

        $this->assertDatabaseHas('users', $json);
    }

    //modification
    public function test_update_user()
    {
        $this->seed();

        $user = User::firstOrFail();

        $json = [
            'firstName' => 'Sow',
            'lastName' => 'Oumar',
            'email' => 'oumar@example.com',
            'phone' => '+15140041144',
        ];

        $response = $this->putJson("/api/users/update/{$user->id}", $json);

        $response->assertJsonFragment($json);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstName' => 'Sow',
            'lastName' => 'Oumar',
            'email' => 'oumar@example.com',
            'phone' => '+15140041144',
        ]);
    }

    //cas des erreurs
    public function test_create_user_without_required_fields()
    {
        $this->seed();

        $json = [];
        $response = $this->postJson('/api/users/create', $json);

        $response->assertStatus(422);
    }

    public function test_update_user_without_required_fields()
    {
        $this->seed();

        $user = User::firstOrFail();

        $json = [];

        $response = $this->putJson("/api/users/update/{$user->id}",  $json);

        $response->assertStatus(422);
    }
}
