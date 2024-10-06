<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmployeeSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            SupplierSeeder::class,
            ItemSeeder::class,
            IncomingItemSeeder::class,
            IncomingItemDetailSeeder::class,
            OutgoingItemSeeder::class,
            SubmissionSessionSeeder::class,
            SubmissionItemSeeder::class,
            RequestItemSeeder::class,
        ]);
    }
}
