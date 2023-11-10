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
    public function run()
    {
            User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@sispam.id',
            'password' => bcrypt('q11w22e33r44'),
        ]);
    }
}
