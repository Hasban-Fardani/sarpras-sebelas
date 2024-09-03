<?php

namespace Database\Seeders;

use App\Models\SubmissionItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubmissionItem::create([
            'id' => 'SM-001',
            'division_id' => '198212311994031004',
            'status' => 'diajukan',
            'total_items' => 5,
        ]);

        SubmissionItem::create([
            'id' => 'SM-002',
            'division_id' => '197412311994031005',
            'status' => 'diajukan',
            'total_items' => 10,
        ]);

        SubmissionItem::create([
            'id' => 'SM-003',
            'division_id' => '198212311994031004',
            'status' => 'diajukan',
            'total_items' => 15,
        ]);
        
        SubmissionItem::create([
            'id' => 'SM-004',
            'division_id' => '197412311994031005',
            'status' => 'diajukan',
            'total_items' => 10,
        ]);
        
        SubmissionItem::create([
            'id' => 'SM-005',
            'division_id' => '197412311994031005',
            'status' => 'diajukan',
            'total_items' => 10,
        ]);
        
        SubmissionItem::create([
            'id' => 'SM-006',
            'division_id' => '197412311994031005',
            'status' => 'diajukan',
            'total_items' => 10,
        ]);
    }
}
