<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class APITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_all_data()
    {
        $this->withoutExceptionHandling();
        $response = $this->getJson('/api/v1/posts');

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Posts retrieved successfully',
        ]);
    }

    public function test_can_store_data()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson('/api/v1/posts', [
            'title' => 'Test Title',
            'category_id' => 1,
            'content' => 'Test Content',
            'user_id' => 1,
        ]);

        $response
        ->assertStatus(201)
        ->assertJson([
            'message' => 'Post created successfully',
        ]);
    }

    public function test_can_show_data()
    {
        $this->withoutExceptionHandling();

        $response = $this->getJson('/api/v1/posts/1');

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Post found',
        ]);
    }

    public function test_can_update_data()
    {
        $this->withoutExceptionHandling();

        $response = $this->putJson('/api/v1/posts/9', [
            'title' => 'Test Title',
            'category_id' => 1,
            'content' => 'Test Content Update',
            'user_id' => 1,
        ]);

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Post updated successfully',
        ]);
    }

    public function test_can_delete_data()
    {
        $this->withoutExceptionHandling();

        $response = $this->deleteJson('/api/v1/posts/9');

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Post deleted successfully',
        ]);
    }
}
