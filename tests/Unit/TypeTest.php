<?php

namespace Tests\Unit;

use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TypeTest extends TestCase
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
        // Crea algunos servicios de prueba
        Type::factory()->count(3)->create();

        // Realiza una solicitud GET al endpoint
        $response = $this->get('/dashboard/type');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('types');
    }

    /** @test */
    public function test_create_store_update_and_delete_endpoints()
    {
        // Datos de type de prueba
        $typeData = [
            'name' => 'Type Example',
            'price' => '100.00',
        ];

        // Crear
        $response = $this->post('/dashboard/type', $typeData);
        $response->assertStatus(302); // Redirección después de crear
        $this->assertDatabaseHas('types', ['name' => 'Type Example']);

        // Obtener el type creado
        $type = Type::where('name', 'Type Example')->first();

        // Actualizar
        $updatedData = [
            'name' => 'Type Updated',
            'price' => '200.00',
        ];
        $response = $this->put("/dashboard/type/{$type->id}", $updatedData);
        $response->assertStatus(302); // Redirección después de actualizar
        $this->assertDatabaseHas('types', ['name' => 'Type Updated']);

        // Eliminar
        $response = $this->delete("/dashboard/type/{$type->id}");
        $response->assertStatus(302); // Redirección después de eliminar
        $this->assertDatabaseMissing('types', ['name' => 'Type Updated']);
    }
}
