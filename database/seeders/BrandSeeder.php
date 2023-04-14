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
                "name" => "Tefal",
                "slug" => "tefal",
                "website" => "https://www.tefal.fr/",
                "contact_email" => "tefal@email.com",
            ]
        );

        Brand::factory()->create(
            [
                "name" => "Kenwood",
                "slug" => "kenwood",
                "website" => "https://www.kenwood.fr/",
                "contact_email" => "kenwood@email.com",
            ]
        );
    }
}
