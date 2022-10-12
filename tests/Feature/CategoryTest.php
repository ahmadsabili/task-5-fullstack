<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_data()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'joe@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($user)->get('/categories');
        $response->assertStatus(200);
    }

    public function test_can_store_data()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'joe@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($user)->post('/categories', [
            'name' => 'Category 1',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Category 1',
            'user_id' => $user->id,
        ]);
    }

    public function test_can_update_data()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'joe@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $category = Category::create([
            'name' => 'Category 1',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->put('/categories/' . $category->id, [
            'name' => 'Category 2',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Category 2',
            'user_id' => $user->id,
        ]);
    }
    
    public function test_can_delete_data()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'joe@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $category = Category::create([
            'name' => 'Category 1',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete('/categories/' . $category->id);

        $this->assertDatabaseMissing('categories', [
            'name' => 'Category 1',
            'user_id' => $user->id,
        ]);
    }
}
