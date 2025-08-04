<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Currency\Entities\Currency;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'balance' => $this->faker->randomFloat(2, 0, 10000),
            'name' => $this->faker->word(),
            'currency_id' => Currency::pluck('id')->random(),
            'type' => $this->faker->randomElement(['cash', 'bank_account', 'credit_card', 'digital_wallet'])
        ];
    }
}
