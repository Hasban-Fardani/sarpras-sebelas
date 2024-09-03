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
            'id' => 'INV-001',
            'employee_id' => '198212311994031004',
            'supplier_id' => 'S0001',
            'note' => 'Barang masuk untuk keperluan testing'
        ]);

        IncomingItem::create([
            'id' => 'INV-002',
            'employee_id' => '198212311994031004',
            'supplier_id' => 'S0002',
            'note' => 'Barang masuk untuk keperluan testing'
        ]);

        IncomingItem::create([
            'id' => 'INV-003',
            'employee_id' => '198212311994031004',
            'supplier_id' => 'S0003',
            'note' => 'Barang masuk untuk keperluan testing'
        ]);

        IncomingItem::create([
            'id' => 'INV-004',
            'employee_id' => '198212311994031004',
            'supplier_id' => 'S0004',
            'note' => 'Barang masuk untuk keperluan testing'
        ]);

        IncomingItem::create([
            'id' => 'INV-005',
            'employee_id' => '198212311994031004',
            'supplier_id' => 'S0005',
            'note' => 'Barang masuk untuk keperluan testing'
        ]);
    }
}
