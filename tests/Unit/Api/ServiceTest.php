<?php

namespace Tests\Unit\Api;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Service;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_service()
    {
        $category = Category::factory()->create();
        $data = ['name' => 'Service test',
                 'description' => 'Service test description',
                 'category_id' => $category->id,];

        $response = $this->postJson('/api/service', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('services', $data);
    }

    /** @test */
    public function it_can_list_services()
    {
        $services = Service::factory()->count(3)->create();

        $response = $this->getJson('/api/service');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'name', 'description', 'category_id', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function it_can_show_a_service()
    {
        $service = Service::factory()->create();

        $response = $this->getJson("/api/service/{$service->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $service->name]);
    }

    /** @test */
    public function it_can_update_a_service()
    {
        $service = Service::factory()->create();
        $category = Category::factory()->create();

        $data = ['name' => 'Service test updated',
                 'description' => 'Service test description updated',
                 'category_id' => $category->id,];

        $response = $this->putJson("/api/service/{$service->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('services', $data);
    }

    /** @test */
    public function it_can_delete_a_service()
    {
        $service = Service::factory()->create();

        $response = $this->deleteJson("/api/service/{$service->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }

    /** @test */
    public function it_can_search_services_by_name()
    {
        $category = Category::factory()->create();
        $service = Service::factory()->create(['name' => 'ServiceTest',
                                               'description' => 'Service test description',
                                               'category_id' => $category->id,]);

        $response = $this->getJson('/api/service/search/ServiceTest');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_get_category_of_a_service()
    {
        $service = Service::factory()->hasCategory(1)->create();

        $response = $this->getJson("/api/service/{$service->id}/category");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'id', 
                    'name', 
                    'created_at', 
                    'updated_at',
                    ]);
    }

    /** @test */
    public function it_can_get_hotels_of_a_service()
    {
        $service = Service::factory()->hasHotels(2)->create();

        $response = $this->getJson("/api/service/{$service->id}/hotels");

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }

    /** @test */
    public function it_can_get_guests_of_a_service()
    {
        $service = Service::factory()->hasGuests(2)->create();

        $response = $this->getJson("/api/service/{$service->id}/guests");

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }
}