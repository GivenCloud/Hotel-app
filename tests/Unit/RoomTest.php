<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Hotel;
use App\Models\Type;
use App\Models\User;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    protected $admin; // Declare the $admin property

    protected function setUp(): void
    {
        parent::setUp();

        // Crear un usuario admin para autenticación
        $this->admin = User::factory()->create(['rol' => 'admin']);

        // Actuar como este usuario admin en todas las pruebas
        $this->actingAs($this->admin);
    }

    /** @test */
    public function test_index_endpoint()
    {
        // Crea algunos roomes de prueba
        Room::factory()->count(3)->create();

        // Realiza una solicitud GET al endpoint
        $response = $this->get('/dashboard/room');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('rooms');
    }

    /** @test */
    public function test_search_endpoint()
    {
        // Crea un room de prueba
        $room = Room::factory()->create(['number' => '1']);

        // Realiza una solicitud GET al endpoint con el término de búsqueda
        $response = $this->get('/dashboard/room/search?search=1');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('roomsSearch');
    }

    /** @test */
    public function test_create_store_update_and_delete_endpoints()
    {
        // Crear datos de prueba para Type y Hotel
        $type = Type::factory()->create();
        $hotel = Hotel::factory()->create();

        // Datos de room de prueba usando los IDs de los datos de prueba creados
        $roomData = [
            'number' => '1',
            'type_id' => $type->id,
            'hotel_id' => $hotel->id,
        ];

        // Crear
        $response = $this->post('/dashboard/room', $roomData);
        $response->assertStatus(302); // Redirección después de crear
        $this->assertDatabaseHas('rooms', ['number' => '1']);

        // Obtener el room creado
        $room = Room::where('number', '1')->first();

        // Actualizar
        $updatedData = [
            'number' => '2',
            'type_id' => $type->id,
            'hotel_id' => $hotel->id,
        ];
        $response = $this->put("/dashboard/room/{$room->id}", $updatedData);
        $response->assertStatus(302); // Redirección después de actualizar
        $this->assertDatabaseHas('rooms', ['number' => '2']);

        // Eliminar
        $response = $this->delete("/dashboard/room/{$room->id}");
        $response->assertStatus(302); // Redirección después de eliminar
        $this->assertDatabaseMissing('rooms', ['number' => '2']);
    }

    /** @test */
    public function test_add_and_remove_guest()
    {
        // Crear room y servicio de prueba
        $room = Room::factory()->create();
        $guest = Guest::factory()->create();

        // Añadir servicio al room
        $guestData = [
            'room_id' => $room->id,
            'guest_id' => [$guest->id],
        ];
        $response = $this->post("/dashboard/room/add-guests/{$room->id}", $guestData);
        $response->assertStatus(302); // Redirección después de añadir el servicio
        $this->assertDatabaseHas('room_guests', [
            'room_id' => $room->id,
            'guest_id' => $guest->id,
        ]);

        // Eliminar servicio del room
        $response = $this->delete("/dashboard/room/delete-guests/{$room->id}/{$guest->id}");
        $response->assertStatus(200); // Redirección después de eliminar el servicio
        $this->assertDatabaseMissing('room_guests', [
            'room_id' => $room->id,
            'guest_id' => $guest->id,
        ]);
    }
}
