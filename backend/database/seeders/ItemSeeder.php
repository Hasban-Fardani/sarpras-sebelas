<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            "code" => "I-001",
            "image" => '/images/pulpen-ae7.jpeg',
            "name" => "Pulpen AE7",
            "category_id" => 1,
            "unit" => "pcs",
            "price" => 2000,
            "stock" => 10,  
            "min_stock" => 5
        ]);

        Item::create([
            "code" => "I-002",
            "image" => '/images/buku-sidu-38.jpeg',
            "name" => "Buku Sidu 38 Lembar",
            "category_id" => 1,
            "unit" => "pcs",
            "price" => 4000,
            "stock" => 10,  
            "min_stock" => 5
        ]);

        Item::create([
            "code" => "I-003",
            "image" => '/images/kertas-sidu-a4.jpeg',
            "name" => "Kertas Sidu A4",
            "category_id" => 1,
            "unit" => "rim",
            "price" => 15000,
            "stock" => 10,  
            "min_stock" => 5
        ]);

        Item::create([
            "code" => "I-004",
            "image" => '/images/pulpen-joyko-gp-265.jpeg',
            "name" => "Pulpen Joyko GP 265",
            "category_id" => 1,
            "unit" => "pcs",
            "price" => 2000,
            "stock" => 10,
            "min_stock" => 5
        ]);

        Item::create([
            "code" => "I-005",
            "image" => '/images/spidol-snowman-boardmarker.jpeg',
            "name" => "Spidol Snowman Boardmarker",
            "category_id" => 1,
            "unit" => "pcs",
            "price" => 8000,
            "stock" => 10,
            "min_stock" => 5
        ]);

        Item::factory(10)->create();
    }
}
