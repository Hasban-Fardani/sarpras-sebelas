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
            'code' => 'IN-001',
            'division_id' => 4,
            'status' => 'diajukan',
        ]);

        SubmissionItem::create([
            'code' => 'IN-002',
            'division_id' => 5,
            'status' => 'draf',
        ]);

        SubmissionItem::create([
            'code' => 'IN-003',
            'division_id' => 4,
            'status' => 'disetujui',
        ]);
        
        SubmissionItem::create([
            'code' => 'IN-004',
            'division_id' => 5,
            'status' => 'ditolak',
        ]);
        
        SubmissionItem::create([
            'code' => 'IN-005',
            'division_id' => 5,
            'status' => 'diajukan',
        ]);
        
        SubmissionItem::create([
            'code' => 'IN-006',
            'division_id' => 5,
            'status' => 'disetujui',
        ]);

        SubmissionItem::factory(5)->create();
    }
}
