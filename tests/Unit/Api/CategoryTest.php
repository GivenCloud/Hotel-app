<?php

namespace Tests\Unit\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_category()
    {
        $data = ['name' => 'Category 1'];

        $response = $this->postJson('/api/category', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('categories', $data);
    }

    /** @test */
    public function it_can_list_categories()
    {
        $categories = Category::factory()->count(3)->create();

        $response = $this->getJson('/api/category');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'name', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function it_can_show_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/api/category/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $category->name]);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create();

        $data = ['name' => 'Category Updated'];

        $response = $this->putJson("/api/category/{$category->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('categories', $data);
    }

    /** @test */
    public function it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/category/{$category->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /** @test */
    public function it_can_search_categories_by_name()
    {
        $category = Category::factory()->create(['name' => 'Name',]);

        $response = $this->getJson('/api/category/search/Name');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_get_services_of_a_category()
    {
        $category = Category::factory()->hasServices(2)->create();

        $response = $this->getJson("/api/category/{$category->id}/services");

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }
}
