<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login()
    {
        $response = $this->get('/login');

        $response = $this->post('/login', [
            'email' => 'user@gmail.com',
            'password' => 'password']);
        $response->assertRedirect('/posts');
    }
}
