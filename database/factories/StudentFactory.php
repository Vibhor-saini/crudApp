<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    return [
        'name' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail(),
        'dob' => $this->faker->date('Y-m-d', '2005-01-01'),
        'gender' => $this->faker->randomElement(['Male', 'Female']),
        'country' => $this->faker->randomElement([
            'India', 'Berlin', 'Boston', 'Chicago', 'London', 'Los Angeles', 'New York', 'Paris', 'San Francisco'
        ]),
        'skills' => $this->faker->randomElement([
            'Programming, marketing, design',
        ]),
        'image' => $this->faker->randomElement([
            'alice.jpg',
            'bob.jpg',
            'emma.jpg',
            'grace.jpg',
            'farhan.jpg'
        ]),
    ];
}

}
