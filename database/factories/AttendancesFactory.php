<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AttendancesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => $this->faker->numberBetween(1, 2),
            // presence date in this month only
            'presence_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'presence_status' => $this->faker->randomElement(['Hadir', 'Izin', 'Sakit', 'Cuti', 'Alpha']),
            'presence_desc' => $this->faker->sentence(),
            'clock_in' => $this->faker->time(),
            'clock_out' => $this->faker->time(),
            'location_in' => $this->faker->latitude() . ' ' . $this->faker->longitude(),
            'location_out' => $this->faker->latitude() . ' ' . $this->faker->longitude(),
            'presence_pict_in' => $this->faker->imageUrl(),
            'presence_pict_out' => $this->faker->imageUrl(),

        ];
    }
}
