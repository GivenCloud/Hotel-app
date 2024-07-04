<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
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
        Category::factory()->count(3)->create();

        // Realiza una solicitud GET al endpoint
        $response = $this->get('/dashboard/category');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que la respuesta tenga la estructura esperada
        $response->assertViewHas('categories');
    }

    /** @test */
    public function test_create_store_update_and_delete_endpoints()
    {
        // Datos de category de prueba
        $categoryData = [
            'name' => 'Category Example',
        ];

        // Crear
        $response = $this->post('/dashboard/category', $categoryData);
        $response->assertStatus(302); // Redirección después de crear
        $this->assertDatabaseHas('categories', ['name' => 'Category Example']);

        // Obtener el category creado
        $category = Category::where('name', 'Category Example')->first();

        // Actualizar
        $updatedData = [
            'name' => 'Category Updated',
        ];
        $response = $this->put("/dashboard/category/{$category->id}", $updatedData);
        $response->assertStatus(302); // Redirección después de actualizar
        $this->assertDatabaseHas('categories', ['name' => 'Category Updated']);

        // Eliminar
        $response = $this->delete("/dashboard/category/{$category->id}");
        $response->assertStatus(302); // Redirección después de eliminar
        $this->assertDatabaseMissing('categories', ['name' => 'Category Updated']);
    }
}
