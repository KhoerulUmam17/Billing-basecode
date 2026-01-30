<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class ContactsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'name' => $this->faker->firstName().' '.$this->faker->lastName(),
            'status' => 'new',
            'phone' => fake()->numberBetween(0, 8098),
            'job_title' => $this->faker->randomElement([
                'Direksi',
                'Managerial',
                'Staff',
                'Owner',
                'Wiraswasta',
                'ASN',
            ]),
            'email' => $this->faker->email(),
            'address' => $this->faker->word,
            'city' => $this->faker->city(),
            'assigned_to' => 'developerm',
        ];
    }
}
