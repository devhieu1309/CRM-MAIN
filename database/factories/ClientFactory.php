<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => fake()->firstName() . " " . fake()->lastName(),
            'customer_email' => fake()->userName() . '@gmail.com',
            'customer_phone' => fake()->phoneNumber(),
            'company_name' => fake()->company(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'tax_code' => fake()->numerify('##########'),
        ];
    }
}
