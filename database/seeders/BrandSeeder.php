<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()->create(
            [
                "name" => "Bosch",
                "slug" => "bosch",
                "image" => "brand_logo/47ssFVhGWqZGFEsrV1VqmALuxY7AwugJfBWC1OY6.jpg",
                "website" => "https://www.tefal.fr/",
                "contact_email" => "bosch@email.com",
            ]
        );
    }
}
