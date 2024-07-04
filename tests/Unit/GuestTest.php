<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Guest;
use App\Models\Service;
use App\Models\Room;
use App\Models\User;

class GuestTest extends TestCase
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
        // Crea algunos guests de prueba
        Guest::factory()->count(3)->create();

        // Realiza una solicitud GET al endpoint
        $response = $this->get('/dashboard/guest');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('guests');
    }

    /** @test */
    public function test_search_endpoint()
    {
        // Crea un guest de prueba
        $guest = Guest::factory()->create(['name' => 'NAME TEST']);

        // Realiza una solicitud GET al endpoint con el término de búsqueda
        $response = $this->get('/dashboard/guest/search?search=NAME TEST');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('guestsSearch');
    }

    /** @test */
    public function test_create_store_update_and_delete_endpoints()
    {
        // Datos de guest de prueba usando los IDs de los datos de prueba creados
        $guestData = [
            'name' => 'NAME TEST',
            'lastName' => 'LAST NAME TEST',
            'dniPassport' => '25563547R',
            'email' => 'EMAIL@TEST.com',
            'phone' => '958914123',
            'checkInDate' => '2021-12-01',
            'checkOutDate' => '2021-12-05',
        ];

        // Crear
        $response = $this->post('/dashboard/guest', $guestData);
        $response->assertStatus(302); // Redirección después de crear
        $this->assertDatabaseHas('guests', ['dniPassport' => '25563547R']);

        // Obtener el guest creado
        $guest = Guest::where('dniPassport', '25563547R')->first();

        // Actualizar
        $updatedData = [
            'name' => 'NAME UPDATED TEST',
            'lastName' => 'LAST NAME UPDATED TEST',
            'dniPassport' => '48789651C',
            'email' => 'EMAIL-updated@TEST.com',
            'phone' => '123456789',
            'checkInDate' => '2021-12-10',
            'checkOutDate' => '2021-12-15',
        ];
        $response = $this->put("/dashboard/guest/{$guest->id}", $updatedData);
        $response->assertStatus(302); // Redirección después de actualizar
        $this->assertDatabaseHas('guests', ['dniPassport' => '48789651C']);

        // Eliminar
        $response = $this->delete("/dashboard/guest/{$guest->id}");
        $response->assertStatus(302); // Redirección después de eliminar
        $this->assertDatabaseMissing('guests', ['dniPassport' => '48789651C']);
    }

    /** @test */
    public function test_add_and_remove_service()
    {
        // Crear guest y servicio de prueba
        $guest = Guest::factory()->create();
        $service = Service::factory()->create();

        // Añadir servicio al guest
        $serviceData = [
            'guest_id' => $guest->id,
            'service_id' => [$service->id],
        ];
        $response = $this->post("/dashboard/guest/add-services/{$guest->id}", $serviceData);
        $response->assertStatus(302); // Redirección después de añadir el servicio
        $this->assertDatabaseHas('guest_services', [
            'guest_id' => $guest->id,
            'service_id' => $service->id,
        ]);

        // Eliminar servicio del guest
        $response = $this->delete("/dashboard/guest/delete-services/{$guest->id}/{$service->id}");
        $response->assertStatus(200); // Redirección después de eliminar el servicio
        $this->assertDatabaseMissing('guest_services', [
            'guest_id' => $guest->id,
            'service_id' => $service->id,
        ]);
    }

    /** @test */
    public function test_add_and_remove_room()
    {
        // Crear guest y habitación de prueba
        $guest = Guest::factory()->create();
        $room = Room::factory()->create();

        // Añadir habitación al guest
        $roomData = [
            'guest_id' => $guest->id,
            'room_id' => [$room->id],
        ];
        $response = $this->post("/dashboard/guest/add-rooms/{$guest->id}", $roomData);
        $response->assertStatus(302); // Redirección después de añadir el servicio
        $this->assertDatabaseHas('room_guests', [
            'guest_id' => $guest->id,
            'room_id' => $room->id,
        ]);

        // Eliminar habitación del guest
        $response = $this->delete("/dashboard/guest/delete-rooms/{$guest->id}/{$room->id}");
        $response->assertStatus(200); // Redirección después de eliminar el servicio
        $this->assertDatabaseMissing('room_guests', [
            'guest_id' => $guest->id,
            'room_id' => $room->id,
        ]);
    }
}