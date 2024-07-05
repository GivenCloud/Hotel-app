<?php

namespace Tests\Unit\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Type;

class TypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_type()
    {
        $data = ['name' => 'Type 1',
                 'price' => 1000,];

        $response = $this->postJson('/api/type', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('types', $data);
    }

    /** @test */
    public function it_can_list_types()
    {
        $types = Type::factory()->count(3)->create();

        $response = $this->getJson('/api/type');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'name', 'price', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function it_can_show_a_type()
    {
        $type = Type::factory()->create();

        $response = $this->getJson("/api/type/{$type->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $type->name]);
    }

    /** @test */
    public function it_can_update_a_type()
    {
        $type = Type::factory()->create();

        $data = ['name' => 'Type Updated',
                 'price' => 2000,];

        $response = $this->putJson("/api/type/{$type->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('types', $data);
    }

    /** @test */
    public function it_can_delete_a_type()
    {
        $type = Type::factory()->create();

        $response = $this->deleteJson("/api/type/{$type->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('types', ['id' => $type->id]);
    }

    /** @test */
    public function it_can_search_types_by_name()
    {
        $type = Type::factory()->create(['name' => 'Name',]);

        $response = $this->getJson('/api/type/search/Name');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_get_rooms_of_a_type()
    {
        $type = Type::factory()->hasRooms(2)->create();

        $response = $this->getJson("/api/type/{$type->id}/rooms");

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }
}
