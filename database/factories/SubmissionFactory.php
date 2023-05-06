<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'employee_id' => 3,
            'submission_type' => $this->faker->numberBetween(1, 5),
            // start_timeoff and finish_timeoff must be in the same month
            'start_timeoff' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'finish_timeoff' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'submission_desc' => $this->faker->text(200),
            'submission_file' => $this->faker->text(20),
            'submission_status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
