<?php

namespace Database\Seeders;

use App\Models\Attendances;
use App\Models\Submission;
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

        // run factories
        Attendances::factory(40)->create();
    }
}
