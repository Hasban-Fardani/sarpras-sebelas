<?php

namespace Database\Seeders;

use App\Models\RequestItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestItem::create([
            'code' => 'RQ-001',
            'employee_id' => 4,
            'status' => 'diajukan',
        ]);

        RequestItem::create([
            'code' => 'RQ-002',
            'employee_id' => 5,
            'status' => 'draf',
        ]);

        RequestItem::create([
            'code' => 'RQ-003',
            'employee_id' => 4,
            'status' => 'disetujui',
        ]);

        RequestItem::create([
            'code' => 'RQ-004',
            'employee_id' => 5,
            'status' => 'diajukan',
        ]);

        RequestItem::create([
            'code' => 'RQ-005',
            'employee_id' => 4,
            'status' => 'disetujui',
        ]);

        RequestItem::factory(5)->create();
    }
}
