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
            'id' => 'RQ-001',
            'employee_id' => '198212311994031004',
            'status' => 'diajukan',
            'total_items' => 5,
        ]);

        RequestItem::create([
            'id' => 'RQ-002',
            'employee_id' => '197412311994031005',
            'status' => 'diajukan',
            'total_items' => 5,
        ]);

        RequestItem::create([
            'id' => 'RQ-003',
            'employee_id' => '197412311994031005',
            'status' => 'diajukan',
            'total_items' => 5,
        ]);

        RequestItem::create([
            'id' => 'RQ-004',
            'employee_id' => '198212311994031004',
            'status' => 'diajukan',
            'total_items' => 5,
        ]);

        RequestItem::create([
            'id' => 'RQ-005',
            'employee_id' => '197412311994031005',
            'status' => 'diajukan',
            'total_items' => 5,
        ]);
    }
}
