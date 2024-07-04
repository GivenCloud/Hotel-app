<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Service;
use App\Models\Hotel;
use App\Models\Guest;
use App\Models\User;

class ServiceTest extends TestCase
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
        // Crea algunos services de prueba
        Service::factory()->count(3)->create();

        // Realiza una solicitud GET al endpoint
        $response = $this->get('/dashboard/service');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('services');
    }

    /** @test */
    public function test_search_endpoint()
    {
        // Crea un service de prueba
        $service = Service::factory()->create(['name' => 'NAME TEST']);

        // Realiza una solicitud GET al endpoint con el término de búsqueda
        $response = $this->get('/dashboard/service/search?search=NAME TEST');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('servicesSearch');
    }

    /** @test */
    public function test_create_store_update_and_delete_endpoints()
    {
        // Crear datos de prueba para Type y Hotel
        $category = Category::factory()->create();

        // Datos de service de prueba usando los IDs de los datos de prueba creados
        $serviceData = [
            'name' => 'NAME TEST',
            'description' => 'DESCRIPTION TEST',
            'category_id' => $category->id,
        ];

        // Crear
        $response = $this->post('/dashboard/service', $serviceData);
        $response->assertStatus(302); // Redirección después de crear
        $this->assertDatabaseHas('services', ['name' => 'NAME TEST']);

        // Obtener el service creado
        $service = Service::where('name', 'NAME TEST')->first();

        // Actualizar
        $updatedData = [
            'name' => 'NAME UPDATED TEST',
            'description' => 'DESCRIPTION UPDATED TEST',
            'category_id' => $category->id,
        ];
        $response = $this->put("/dashboard/service/{$service->id}", $updatedData);
        $response->assertStatus(302); // Redirección después de actualizar
        $this->assertDatabaseHas('services', ['name' => 'NAME UPDATED TEST']);

        // Eliminar
        $response = $this->delete("/dashboard/service/{$service->id}");
        $response->assertStatus(302); // Redirección después de eliminar
        $this->assertDatabaseMissing('services', ['name' => 'NAME UPDATED TEST']);
    }

    /** @test */
    public function test_add_and_remove_hotel()
    {
        // Crear service y hotel de prueba
        $service = Service::factory()->create();
        $hotel = Hotel::factory()->create();

        // Añadir hotel al service
        $serviceData = [
            'service_id' => $service->id,
            'hotel_id' => [$hotel->id],
        ];
        $response = $this->post("/dashboard/service/add-hotels/{$service->id}", $serviceData);
        $response->assertStatus(302); // Redirección después de añadir el servicio
        $this->assertDatabaseHas('hotel_services', [
            'service_id' => $service->id,
            'hotel_id' => $hotel->id,
        ]);

        // Eliminar hotel del service
        $response = $this->delete("/dashboard/service/delete-hotels/{$service->id}/{$hotel->id}");
        $response->assertStatus(200); // Redirección después de eliminar el servicio
        $this->assertDatabaseMissing('hotel_services', [
            'service_id' => $service->id,
            'hotel_id' => $hotel->id,
        ]);
    }

    /** @test */
    public function test_add_and_remove_guest()
    {
        // Crear service y guest de prueba
        $service = Service::factory()->create();
        $guest = Guest::factory()->create();

        // Añadir guest al service
        $guestData = [
            'service_id' => $service->id,
            'guest_id' => [$guest->id],
        ];
        $response = $this->post("/dashboard/service/add-guests/{$service->id}", $guestData);
        $response->assertStatus(302); // Redirección después de añadir el servicio
        $this->assertDatabaseHas('guest_services', [
            'service_id' => $service->id,
            'guest_id' => $guest->id,
        ]);

        // Eliminar guest del service
        $response = $this->delete("/dashboard/service/delete-guests/{$service->id}/{$guest->id}");
        $response->assertStatus(200); // Redirección después de eliminar el servicio
        $this->assertDatabaseMissing('guest_services', [
            'service_id' => $service->id,
            'guest_id' => $guest->id,
        ]);
    }
}