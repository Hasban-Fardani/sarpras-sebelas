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
            'regarding' => 'biasa',
            'submission_session_id' => 1
        ]);

        SubmissionItem::create([
            'code' => 'IN-002',
            'division_id' => 5,
            'status' => 'draf',
            'regarding' => 'biasa',
            'submission_session_id' => 1
        ]);

        SubmissionItem::create([
            'code' => 'IN-003',
            'division_id' => 4,
            'status' => 'disetujui',
            'regarding' => 'biasa',
            'submission_session_id' => 1
        ]);
        
        SubmissionItem::create([
            'code' => 'IN-004',
            'division_id' => 5,
            'status' => 'ditolak',
            'regarding' => 'biasa',
            'submission_session_id' => 2
        ]);
        
        SubmissionItem::create([
            'code' => 'IN-005',
            'division_id' => 5,
            'status' => 'diajukan',
            'regarding' => 'biasa',
            'submission_session_id' => 2
        ]);
        
        SubmissionItem::create([
            'code' => 'IN-006',
            'division_id' => 5,
            'status' => 'disetujui',
            'regarding' => 'biasa',
            'submission_session_id' => 2
        ]);

        SubmissionItem::factory(5)->create();
    }
}
