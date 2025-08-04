<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::pluck('id')->random(),
            'amount' => $this->faker->randomFloat(2, 0, 100000),
            'type' => $this->faker->randomElement(['revenue', 'expense']),
        ];
    }
}
