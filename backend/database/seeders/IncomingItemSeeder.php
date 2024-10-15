<?php

namespace Database\Seeders;

use App\Models\IncomingItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IncomingItem::create([
            'code' => 'INV-001',
            'operator_id' => 3,
            'supplier_id' => 1,
            'note' => 'Barang masuk untuk keperluan testing'
        ]);

        IncomingItem::create([
            'code' => 'INV-002',
            'operator_id' => 3,
            'supplier_id' => 2,
            'note' => 'Barang masuk untuk keperluan testing'
        ]);

        IncomingItem::create([
            'code' => 'INV-003',
            'operator_id' => 3,
            'supplier_id' => 3,
            'note' => 'Barang masuk untuk keperluan testing'
        ]);

        IncomingItem::create([
            'code' => 'INV-004',
            'operator_id' => 3,
            'supplier_id' => 4,
            'note' => 'Barang masuk untuk keperluan testing'
        ]);

        IncomingItem::create([
            'code' => 'INV-005',
            'operator_id' => 3,
            'supplier_id' => 5,
            'note' => 'Barang masuk untuk keperluan testing'
        ]);

        IncomingItem::factory(5)->create();
    }
}
