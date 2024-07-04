<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Hotel;
use App\Models\Service;
use App\Models\User;

class HotelTest extends TestCase
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
        // Crea algunos hoteles de prueba
        Hotel::factory()->count(3)->create();

        // Realiza una solicitud GET al endpoint
        $response = $this->get('/dashboard/hotel');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('hotels');
    }

    /** @test */
    public function test_search_endpoint()
    {
        // Crea un hotel de prueba
        $hotel = Hotel::factory()->create(['name' => 'Hotel Test']);

        // Realiza una solicitud GET al endpoint con el término de búsqueda
        $response = $this->get('/dashboard/hotel/search?search=Hotel Test');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('hotelsSearch');
    }

    /** @test */
    public function test_create_store_update_and_delete_endpoints()
    {
        // Datos de hotel de prueba
        $hotelData = [
            'name' => 'Hotel Example',
            'address' => '123 Example Street',
            'phone' => '123456789',
            'email' => 'example@hotel.com',
            'website' => 'http://example.com',
        ];

        // Crear
        $response = $this->post('/dashboard/hotel', $hotelData);
        $response->assertStatus(302); // Redirección después de crear
        $this->assertDatabaseHas('hotels', ['email' => 'example@hotel.com']);

        // Obtener el hotel creado
        $hotel = Hotel::where('email', 'example@hotel.com')->first();

        // Actualizar
        $updatedData = [
            'name' => 'Hotel Updated',
            'address' => '456 Updated Street',
            'phone' => '987654321',
            'email' => 'updated@hotel.com',
            'website' => 'http://updated.com',
        ];
        $response = $this->put("/dashboard/hotel/{$hotel->id}", $updatedData);
        $response->assertStatus(302); // Redirección después de actualizar
        $this->assertDatabaseHas('hotels', ['email' => 'updated@hotel.com']);

        // Eliminar
        $response = $this->delete("/dashboard/hotel/{$hotel->id}");
        $response->assertStatus(302); // Redirección después de eliminar
        $this->assertDatabaseMissing('hotels', ['email' => 'updated@hotel.com']);
    }

    /** @test */
    public function test_add_and_remove_service()
    {
        // Crear hotel y servicio de prueba
        $hotel = Hotel::factory()->create();
        $service = Service::factory()->create();

        // Añadir servicio al hotel
        $serviceData = [
            'hotel_id' => $hotel->id,
            'service_id' => [$service->id],
        ];
        $response = $this->post("/dashboard/hotel/add-services/{$hotel->id}", $serviceData);
        $response->assertStatus(302); // Redirección después de añadir el servicio
        $this->assertDatabaseHas('hotel_services', [
            'hotel_id' => $hotel->id,
            'service_id' => $service->id,
        ]);

        // Eliminar servicio del hotel
        $response = $this->delete("/dashboard/hotel/delete-services/{$hotel->id}/{$service->id}");
        $response->assertStatus(200); // Redirección después de eliminar el servicio
        $this->assertDatabaseMissing('hotel_services', [
            'hotel_id' => $hotel->id,
            'service_id' => $service->id,
        ]);
    }
}
