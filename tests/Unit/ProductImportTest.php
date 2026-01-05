<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_import_creates_model_with_correct_data()
    {
        $import = new ProductsImport();
        
        $row = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 29.99,
            'category' => 'Electronics',
            'stock' => 100,
            'image' => 'test-image.jpg'
        ];

        $product = $import->model($row);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals('Test Description', $product->description);
        $this->assertEquals(29.99, $product->price);
        $this->assertEquals('Electronics', $product->category);
        $this->assertEquals(100, $product->stock);
        $this->assertEquals('test-image.jpg', $product->image);
    }

    public function test_product_import_uses_default_image_when_empty()
    {
        $import = new ProductsImport();
        
        $row = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 29.99,
            'category' => 'Electronics',
            'stock' => 100,
            'image' => null
        ];

        $product = $import->model($row);

        $this->assertEquals('default-product.jpg', $product->image);
    }

    public function test_product_import_validation_rules()
    {
        $import = new ProductsImport();
        $rules = $import->rules();

        $expectedRules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string',
        ];

        $this->assertEquals($expectedRules, $rules);
    }

    public function test_product_import_chunk_size()
    {
        $import = new ProductsImport();
        
        $this->assertEquals(1000, $import->chunkSize());
    }
}