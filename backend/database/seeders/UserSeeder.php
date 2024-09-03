<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin: pak toni
        User::create([
            'id' => 1,
            'username' => 'admin',
            'id' => '197806311994031003',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Pengawas: pak sutarsa
        User::create([
            'id' => 2,
            'username' => 'pengawas',
            'id' => '197412311994031001',
            'role' => 'pengawas',
            'password' => bcrypt('password'),
        ]);

        // unit kerja: bu Ani
        User::create([
            'id' => 3,
            'username' => 'ani_nuraeni',
            'id' => '198212311994031004',
            'role' => 'unit',
            'password' => bcrypt('password'),
        ]);

        // unit kerja: pa zim zim
        User::create([
            'id' => 4,
            'username' => 'zim_zim',
            'id' => '197412311994031005',
            'role' => 'unit',
            'password' => bcrypt('password'),
        ]);
    }
}
