<?php

namespace Database\Seeders;

use App\Models\SubmissionCart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubmissionCart::factory(100)->create();
    }
}
