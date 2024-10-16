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
            'division_id' => 4,
            'operator_id' => 3,
            'regarding' => 'test',
            'characteristic' => 'tesssss',
            'status' => 'diajukan',
        ]);

        RequestItem::create([
            'code' => 'RQ-002',
            'division_id' => 5,
            'operator_id' => 3,
            'regarding' => 'test',
            'characteristic' => 'tesssss',
            'status' => 'draf',
        ]);

        RequestItem::create([
            'code' => 'RQ-003',
            'division_id' => 4,
            'operator_id' => 3,
            'regarding' => 'test',
            'characteristic' => 'tesssss',
            'status' => 'disetujui',
        ]);

        RequestItem::create([
            'code' => 'RQ-004',
            'division_id' => 5,
            'operator_id' => 3,
            'regarding' => 'test',
            'characteristic' => 'tesssss',
            'status' => 'diajukan',
        ]);

        RequestItem::create([
            'code' => 'RQ-005',
            'division_id' => 4,
            'operator_id' => 3,
            'regarding' => 'test',
            'characteristic' => 'tesssss',
            'status' => 'disetujui',
        ]);

        RequestItem::factory(5)->create();
    }
}
