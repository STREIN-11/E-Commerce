<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'category' => $row['category'],
            'stock' => $row['stock'],
            'image' => $row['image'] ?? 'default-product.jpg',
        ]);
    }

    public function chunkSize(): int
    {
        return 1000; // Process 1000 rows at a time
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string',
        ];
    }
}