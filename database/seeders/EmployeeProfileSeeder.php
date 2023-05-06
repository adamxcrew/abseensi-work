<?php

namespace Database\Seeders;

use App\Models\EmployeeProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [
            [
                'uuid' => Str::uuid(),
                'user_id' => 1,
                'employee_tier' => 'administrator',
                'employee_stats' => 'tetap',
                'institution' => 'SMK Wikrama Bogor',
                'join_date' => '2019-01-01',
                'stop_date' => null,
            ],
            [
                'uuid' => Str::uuid(),
                'user_id' => 2,
                'employee_tier' => 'tata usaha',
                'employee_stats' => 'kontrak',
                'institution' => 'SMK Wikrama Bogor',
                'join_date' => '2020-01-01',
                'stop_date' => null,
            ],
            [
                'uuid' => Str::uuid(),
                'user_id' => 3,
                'employee_tier' => 'guru',
                'employee_stats' => 'kontrak',
                'institution' => 'SMK Wikrama Bogor',
                'join_date' => '2020-01-01',
                'stop_date' => null,
            ],
            ];

        EmployeeProfile::insert($employee);
    }
}
