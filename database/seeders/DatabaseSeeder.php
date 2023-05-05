<?php

namespace Database\Seeders;

use App\Models\Attendances;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PersonalProfileSeeder::class,
            EmployeeProfileSeeder::class,
            TimeOffSettingSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
        Attendances::factory(20)->create();
    }
}
