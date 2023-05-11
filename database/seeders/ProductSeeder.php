<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->create([
            "name" => "Fouet électrique",
            "price" => "15.99",
            "brand_id" => 1,
            "image" => "product_image/fouet.jpg",
            "description" => fake()->paragraph(5),
        ]);
    }
}
