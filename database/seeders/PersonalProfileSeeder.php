<?php

namespace Database\Seeders;

use App\Models\PersonalProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PersonalProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personalProfiles = [
            [
                'uuid'=> Str::uuid(),
                'user_id'=> 1,
                'nik'=> '3271010101010001',
                'address'=> 'Jl lorem ipsum 1',
                'marriage'=> 'kawin',
                'phone_number'=> '081234567891',
                'birth_date'=> '2000-01-01',
                'birth_place'=> 'lorem 1',
                'gender'=> 'male',
                'religion'=> 'islam',
                'created_at'=> now(),
            ],
            [
                'uuid'=> Str::uuid(),
                'user_id'=> 2,
                'nik'=> '3271010101010002',
                'address'=> 'Jl lorem ipsum 2',
                'marriage'=> 'belum kawin',
                'phone_number'=> '081234567892',
                'birth_date'=> '2000-01-02',
                'birth_place'=> 'lorem 2',
                'gender'=> 'male',
                'religion'=> 'islam',
                'created_at'=> now(),
            ],
            [
                'uuid'=> Str::uuid(),
                'user_id'=> 3,
                'nik'=> '3271010101010003',
                'address'=> 'Jl lorem ipsum 3',
                'marriage'=> 'kawin',
                'phone_number'=> '081234567893',
                'birth_date'=> '2000-01-03',
                'birth_place'=> 'lorem 3',
                'gender'=> 'male',
                'religion'=> 'islam',
                'created_at'=> now(),
            ],
        ];

        PersonalProfile::insert($personalProfiles);
    }
}
