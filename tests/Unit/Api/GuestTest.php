<?php

namespace Tests\Unit\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Guest;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_guest()
    {
        $data = ['name' => 'John', 
                 'lastName' => 'Doe',
                 'dniPassport' => '12345678A',
                 'email' => 'john@gmail.com',
                 'phone' => '123456789',
                 'checkInDate' => '2021-10-10',
                 'checkOutDate' => '2021-10-15'];

        $response = $this->postJson('/api/guest', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('guests', $data);
    }

    /** @test */
    public function it_can_list_guests()
    {
        $guests = Guest::factory()->count(3)->create();

        $response = $this->getJson('/api/guest');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'name', 'lastName', 'dniPassport', 'email', 'phone', 'checkInDate', 'checkOutDate', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function it_can_show_a_guest()
    {
        $guest = Guest::factory()->create();

        $response = $this->getJson("/api/guest/{$guest->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $guest->name]);
    }

    /** @test */
    public function it_can_update_a_guest()
    {
        $guest = Guest::factory()->create();

        $data = ['name' => 'Mary', 
                 'lastName' => 'Jane',
                 'dniPassport' => '12345678A',
                 'email' => 'mary@gmail.com',
                 'phone' => '123556789',
                 'checkInDate' => '2021-10-16',
                 'checkOutDate' => '2021-10-20'];

        $response = $this->putJson("/api/guest/{$guest->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('guests', $data);
    }

    /** @test */
    public function it_can_delete_a_guest()
    {
        $guest = Guest::factory()->create();

        $response = $this->deleteJson("/api/guest/{$guest->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('guests', ['id' => $guest->id]);
    }

    /** @test */
    public function it_can_search_guests_by_name()
    {
        $guest = Guest::factory()->create(['name' => 'Name',]);

        $response = $this->getJson('/api/guest/search/Name');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_get_rooms_of_a_guest()
    {
        $guest = Guest::factory()->hasRooms(3)->create();

        $response = $this->getJson("/api/guest/{$guest->id}/rooms");

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_get_services_of_a_guest()
    {
        $guest = Guest::factory()->hasServices(2)->create();

        $response = $this->getJson("/api/guest/{$guest->id}/services");

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }
}
