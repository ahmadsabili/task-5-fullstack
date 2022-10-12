<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_data()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $response = $this->actingAs($user)->get('/posts');
        $response->assertStatus(200);
    }

    public function test_can_store_data()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $category = Category::create([
            'name' => 'Category 1',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'Test Title',
            'content' => 'Test Body',
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $response->assertStatus(302);
    }

    public function test_can_update_data()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $category = Category::create([
            'name' => 'Category 1',
            'user_id' => $user->id,
        ]);

        $post = $user->articles()->create([
            'title' => 'Test Title',
            'content' => 'Test Body',
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        
        $response = $this->actingAs($user)->put('/posts/' . $post->id, [
            'title' => 'Test Title 2',
            'content' => 'Test Body 2',
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('articles', [
            'title' => 'Test Title 2',
            'content' => 'Test Body 2',
        ]);

        $response->assertRedirect('/posts');
        $response->assertStatus(302);
    }

    public function test_can_delete_data()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $category = Category::create([
            'name' => 'Category 1',
            'user_id' => $user->id,
        ]);

        $post = $user->articles()->create([
            'title' => 'Test Title',
            'content' => 'Test Body',
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete('/posts/' . $post->id);
        $this->assertDatabaseMissing('articles', [
            'title' => 'Test Title',
            'content' => 'Test Body',
        ]);
        $response->assertRedirect('/posts');
        $response->assertStatus(302);
    }
}
