<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Review;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::all()->each(function(Book $book) {
            $reviews = Review::factory(random_int(2, 10))->make();
            $book->reviews()->saveMany($reviews);
        });
    }
}
