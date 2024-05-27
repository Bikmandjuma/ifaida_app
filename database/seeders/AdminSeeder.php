<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("admins")->insert([
            [
                'firstname' => 'Bikman',
                'lastname' => 'Djuma',
                'email' => 'ntiruhungwab@gmail.com',
                'phone' => '0785389000',
                'gender' => 'male',
                'username' => 'ntiruhungwab@gmail.com',
                'password' => bcrypt('bugarama123@'),
                'image' => 'user.png'
            ],
            [
                'firstname' => 'Rasul abdi',
                'lastname' => 'Nzeyimana',
                'email' => 'rasul@gmail.com',
                'phone' => '0785389001',
                'gender' => 'male',
                'username' => 'rasul@gmail.com',
                'password' => bcrypt('bugarama123@'),
                'image' => 'user.png'
            ]
        ]);
    }
}
