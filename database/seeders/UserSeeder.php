<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'fullname' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'tu',
                'fullname' => 'tu',
                'email' => 'tu@mail.com',
                'password' => Hash::make('password'),
                'role' => 'tu',
            ],
            [
                'name' => 'teacher',
                'fullname' => 'teacher',
                'email' => 'teacher@mail.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ],
        ];

        User::insert($users);
    }
}
