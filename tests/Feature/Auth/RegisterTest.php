<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_user_can_register()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];
        $response = $this->post('/register', $userData);
        $response->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

    }

    public function test_user_cannot_register_with_invalid_data()
    {

        $invalidUserData = [
            'name' => 'John Doe',
            'email' => 'john.com',
            'password' => 'pass',
            'password_confirmation' => 'password123',
        ];


       $this->post('/register', $invalidUserData);

        $this->assertDatabaseMissing('users', [
            'name' => 'John Doe',
            'email' => 'john.com',
        ]);
    }
}
