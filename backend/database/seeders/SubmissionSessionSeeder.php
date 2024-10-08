<?php

namespace Database\Seeders;

use App\Models\SubmissionSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => '2022',
                'description' => '2022',
                'start_date' => '2022-01-01',
                'end_date' => '2022-12-31'
            ],
            [
                'name' => '2023',
                'description' => '2023',
                'start_date' => '2023-01-01',
                'end_date' => '2023-12-31'
            ],
            [
                'name' => '2024',
                'description' => '2024',
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31'
            ]
        ];

        SubmissionSession::insert($data);
    }
}
