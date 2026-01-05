<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_admin_can_create_product()
    {
        $admin = User::factory()->create(['type' => 'admin']);

        $response = $this->actingAs($admin, 'admin')
            ->post(route('admin.products.store'), [
                'name' => 'Test Product',
                'description' => 'Test Description',
                'price' => 29.99,
                'category' => 'Electronics',
                'stock' => 100,
            ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 29.99,
        ]);
    }

    public function test_customer_cannot_access_product_management()
    {
        $customer = User::factory()->create(['type' => 'customer']);

        $response = $this->actingAs($customer, 'customer')
            ->get(route('admin.products.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_product_creation_validation()
    {
        $admin = User::factory()->create(['type' => 'admin']);

        $response = $this->actingAs($admin, 'admin')
            ->post(route('admin.products.store'), [
                'name' => '',
                'description' => '',
                'price' => -10,
            ]);

        $response->assertSessionHasErrors(['name', 'description', 'price', 'category', 'stock']);
    }

    public function test_admin_can_update_product()
    {
        $admin = User::factory()->create(['type' => 'admin']);
        $product = Product::factory()->create();

        $response = $this->actingAs($admin, 'admin')
            ->put(route('admin.products.update', $product), [
                'name' => 'Updated Product',
                'description' => 'Updated Description',
                'price' => 39.99,
                'category' => 'Updated Category',
                'stock' => 150,
            ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product',
            'price' => 39.99,
        ]);
    }

    public function test_admin_can_delete_product()
    {
        $admin = User::factory()->create(['type' => 'admin']);
        $product = Product::factory()->create();

        $response = $this->actingAs($admin, 'admin')
            ->delete(route('admin.products.destroy', $product));

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}