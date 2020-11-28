<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $paymentTypes = [
            'EUR',
            'GBP',
            'USD'
        ];

        return [
            'id' => $this->faker->randomNumber(8),
            'merchant_transaction_id' => Str::random(20),
            'currency' => $this->faker->currencyCode,
            'payment_type' => $paymentTypes[random_int(0, 2)],
            'amount' => $this->faker->randomNumber(2),
            'ndc' => Str::random(20)
        ];
    }
}
