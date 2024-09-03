<?php

namespace Database\Seeders;

use App\Models\OutgoingItem;
use Illuminate\Database\Seeder;

class OutgoingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OutgoingItem::create([
           'id' => 'OTK-001',
           'operator_id' => '197806311994031003',
           'division_id' => '198212311994031004',
           'total_items' => 5,
           'note' => 'Barang keluar untuk keperluan testing' 
        ]);

        OutgoingItem::create([
            'id' => 'OTK-002',
            'operator_id' => '197806311994031003',
            'division_id' => '198212311994031004',
            'total_items' => 5,
            'note' => 'Barang keluar untuk'
        ]);

        OutgoingItem::create([
            'id' => 'OTK-003',
            'operator_id' => '197806311994031003',
            'division_id' => '198212311994031004',
            'total_items' => 5,
            'note' => 'Barang keluar untuk'
        ]);

        OutgoingItem::create([
            'id' => 'OTK-004',
            'operator_id' => '197806311994031003',
            'division_id' => '198212311994031004',
            'total_items' => 6,
            'note' => 'Barang keluar untuk'
        ]);

        OutgoingItem::create([
            'id' => 'OTK-005',
            'operator_id' => '197806311994031003',
            'division_id' => '198212311994031004',
            'total_items' => 6,
            'note' => 'Barang keluar untuk'
        ]);
    }
}
