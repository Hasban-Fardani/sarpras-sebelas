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
            'code' => 'OUT-001',
            'operator_id' => 1,
            'division_id' => 4,
            'note' => 'Barang keluar untuk keperluan testing'
        ]);

        OutgoingItem::create([
            'code' => 'OUT-002',
            'operator_id' => 1,
            'division_id' => 5,
            'note' => 'Barang keluar untuk'
        ]);

        OutgoingItem::create([
            'code' => 'OUT-003',
            'operator_id' => 1,
            'division_id' => 4,
            'note' => 'Barang keluar untuk'
        ]);

        OutgoingItem::create([
            'code' => 'OUT-004',
            'operator_id' => 1,
            'division_id' => 5,
            'note' => 'Barang keluar untuk'
        ]);

        OutgoingItem::create([
            'code' => 'OUT-005',
            'operator_id' => 1,
            'division_id' => 4,
            'note' => 'Barang keluar untuk'
        ]);

        OutgoingItem::factory(5)->create();
    }
}
