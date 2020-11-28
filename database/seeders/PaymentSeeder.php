<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use App\Models\User;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function(User $user) {

            $payments = Payment::factory(random_int(2, 10))->make();
            $user->payments()->saveMany($payments);
        });
    }
}
