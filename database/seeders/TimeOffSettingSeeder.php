<?php

namespace Database\Seeders;

use App\Models\TimeOffSetting;
use Illuminate\Database\Seeder;

class TimeOffSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeoffs = [
            [
                'jenis_timeoff' => 'Cuti',
                'description_timeoff' => 'Cuti Tahunan',
                'code_timeoff' => 'ct',
                'durasi_timeoff' => 12,
            ],
            [
                'jenis_timeoff' => 'Cuti',
                'description_timeoff' => 'Cuti Melahirkan',
                'code_timeoff' => 'cm',
                'durasi_timeoff' => 90,
            ],
            [
                'jenis_timeoff' => 'Cuti',
                'description_timeoff' => 'Cuti Kerabat Meninggal',
                'code_timeoff' => 'ckm',
                'durasi_timeoff' => 3,
            ],
            [
                'jenis_timeoff' => 'Dinas Luar',
                'description_timeoff' => 'Dinas Luar',
                'code_timeoff' => 'dl',
                'durasi_timeoff' => 1,
            ],
            [
                'jenis_timeoff' => 'Sakit',
                'description_timeoff' => 'Sakit',
                'code_timeoff' => 's',
                'durasi_timeoff' => 1,
            ],
        ];

        TimeOffSetting::insert($timeoffs);
    }
}
