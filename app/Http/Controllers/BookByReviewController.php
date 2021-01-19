<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookByReviewKeyResource;

class BookByReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     // return book based on the review key paramater else return 404
     
    public function __invoke($key, Request $request)
    {
        return new BookByReviewKeyResource(Book::findByReviewKey($key)) ?? abort(404);
    }
}
