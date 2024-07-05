<?php

namespace Tests\Unit\Api;

use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Room;
use App\Models\Type;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_room()
    {
        $type = Type::factory()->create();
        $hotel = Hotel::factory()->create();

        $data = ['number' => '1',
                 'type_id' => $type->id,
                 'hotel_id' => $hotel->id,];

        $response = $this->postJson('/api/room', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('rooms', $data);
    }

    /** @test */
    public function it_can_list_rooms()
    {
        $rooms = Room::factory()->count(3)->create();

        $response = $this->getJson('/api/room');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'number', 'type_id', 'hotel_id', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function it_can_show_a_room()
    {
        $room = Room::factory()->create();

        $response = $this->getJson("/api/room/{$room->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['number' => $room->number]);
    }

    /** @test */
    public function it_can_update_a_room()
    {
        $room = Room::factory()->create();
        $type = Type::factory()->create();
        $hotel = Hotel::factory()->create();
        
        $data = ['number' => '10',
                 'type_id' => $type->id,
                 'hotel_id' => $hotel->id,];

        $response = $this->putJson("/api/room/{$room->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('rooms', $data);
    }

    /** @test */
    public function it_can_delete_a_room()
    {
        $room = Room::factory()->create();

        $response = $this->deleteJson("/api/room/{$room->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('rooms', ['id' => $room->id]);
    }

    /** @test */
    public function it_can_search_rooms_by_number()
    {
        $type = Type::factory()->create();
        $hotel = Hotel::factory()->create();
        $room = Room::factory()->create(['number' => '1',
                                         'type_id' => $type->id,
                                         'hotel_id' => $hotel->id,]);

        $response = $this->getJson('/api/room/search/1');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_get_hotel_of_a_room()
    {
        $room = Room::factory()->hasHotel(1)->create();

        $response = $this->getJson("/api/room/{$room->id}/hotel");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'id', 
                    'name', 
                    'address',
                    'phone',
                    'email',
                    'website', 
                    'created_at', 
                    'updated_at',
                ]);
    }

    /** @test */
    public function it_can_get_guests_of_a_room()
    {
        $room = Room::factory()->hasGuests(2)->create();

        $response = $this->getJson("/api/room/{$room->id}/guests");

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }

    /** @test */
    public function it_can_get_type_of_a_room()
    {
        $room = Room::factory()->create();

        $response = $this->getJson("/api/room/{$room->id}/type");

        $response->assertStatus(200);
    }
}
