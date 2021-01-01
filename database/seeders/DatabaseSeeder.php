<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(BookTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
