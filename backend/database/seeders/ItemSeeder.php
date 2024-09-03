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
            "id" => "I-001",
            "image" => '/images/pulpen-ae7.jpeg',
            "name" => "Pulpen AE7",
            "category_id" => 'ATK',
            "unit" => "pcs",
            "price" => 2000,
            "stock" => 10,  
            "min_stock" => 5
        ]);

        Item::create([
            "id" => "I-002",
            "image" => '/images/buku-sidu-38.jpeg',
            "name" => "Buku Sidu 38 Lembar",
            "category_id" => 'ATK',
            "unit" => "pcs",
            "price" => 4000,
            "stock" => 10,  
            "min_stock" => 5
        ]);

        Item::create([
            "id" => "I-003",
            "image" => '/images/kertas-sidu-a4.jpeg',
            "name" => "Kertas Sidu A4",
            "category_id" => 'ATK',
            "unit" => "rim",
            "price" => 15000,
            "stock" => 10,  
            "min_stock" => 5
        ]);

        Item::create([
            "id" => "I-004",
            "image" => '/images/pulpen-joyko-gp-265.jpeg',
            "name" => "Pulpen Joyko GP 265",
            "category_id" => 'ATK',
            "unit" => "pcs",
            "price" => 2000,
            "stock" => 10,
            "min_stock" => 5
        ]);

        Item::create([
            "id" => "I-005",
            "image" => '/images/spidol-snowman-boardmarker.jpeg',
            "name" => "Spidol Snowman Boardmarker",
            "category_id" => 'ATK',
            "unit" => "pcs",
            "price" => 8000,
            "stock" => 10,
            "min_stock" => 5
        ]);
    }
}
