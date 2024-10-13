<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_code' => $this->faker->bothify('USR###??'),
            'date_entered' => $dateEntered = $this->faker->dateTimeBetween('September 1st ' . now()->year, 'now'),
            'transaction_id' => $this->faker->numberBetween(1, 3), // Assuming transaction IDs are 1, 2, or 3
            'reference_no' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'remarks' => $this->faker->sentence(), // Ensure remarks are always generated
            'expiry_date_time' => $this->faker->dateTimeBetween($dateEntered, 'December 31, ' . now()->year), // Expiry date within this year
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}


/*
class TicketsFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user_code' => $this->faker->bothify('USR###??'),
            'date_entered' => $this->faker->date('Y-m-d', now()), // Ensures date is in the current year
            'transaction_id' => $this->faker->numberBetween(1, 3), // Assuming transaction IDs are 1, 2, or 3
            'reference_no' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'remarks' => $this->faker->sentence(), // Ensure remarks are always generated
            'expiry_date_time' => $this->faker->dateTimeBetween('now', 'December 31, ' . now()->year), // Expiry date within this year
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
*/