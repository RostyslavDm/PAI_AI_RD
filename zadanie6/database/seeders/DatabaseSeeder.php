<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'       => 'Administrator',
                'email'      => 'admin@calc.pl',
                'password'   => Hash::make('admin123'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Użytkownik',
                'email'      => 'user@calc.pl',
                'password'   => Hash::make('user123'),
                'role'       => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}