<?php

namespace Tests\Unit\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Hotel;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_an_hotel()
    {
        $data = ['name' => 'New Hotel',
                 'address' => '123 New Street',
                 'phone' => '123456789',
                 'email' => 'hotel@email.com',
                 'website' => 'http://hotel.com'];

        $response = $this->postJson('/api/hotel', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('hotels', $data);
    }

    /** @test */
    public function it_can_list_hotels()
    {
        $hotels = Hotel::factory()->count(3)->create();

        $response = $this->getJson('/api/hotel');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'name', 'address', 'phone', 'email', 'website', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function it_can_show_a_hotel()
    {
        $hotel = Hotel::factory()->create();

        $response = $this->getJson("/api/hotel/{$hotel->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $hotel->name]);
    }

    /** @test */
    public function it_can_update_a_hotel()
    {
        $hotel = Hotel::factory()->create();
        $data = ['name' => 'Updated Hotel',
                'address' => '456 Updated Street',
                'phone' => '987654321',
                'email' => 'hotel-updated@email.com',
                'website' => 'http://hotel-updated.com'];

        $response = $this->putJson("/api/hotel/{$hotel->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('hotels', $data);
    }

    /** @test */
    public function it_can_delete_a_hotel()
    {
        $hotel = Hotel::factory()->create();

        $response = $this->deleteJson("/api/hotel/{$hotel->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('hotels', ['id' => $hotel->id]);
    }

    /** @test */
    public function it_can_search_hotels_by_name()
    {
        $hotel = Hotel::factory()->create([ 'name' => 'Specific Hotel',
                                            'address' => 'New Street',
                                            'phone' => '123458789',
                                            'email' => 'new-hotel@email.com',
                                            'website' => 'http://new-hotel.com']);

        $response = $this->getJson('/api/hotel/search/Specific');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Specific Hotel']);
    }

    /** @test */
    public function it_can_get_rooms_of_a_hotel()
    {
        $hotel = Hotel::factory()->hasRooms(3)->create();

        $response = $this->getJson("/api/hotel/{$hotel->id}/rooms");

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_get_services_of_a_hotel()
    {
        $hotel = Hotel::factory()->hasServices(2)->create();

        $response = $this->getJson("/api/hotel/{$hotel->id}/services");

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }
}
