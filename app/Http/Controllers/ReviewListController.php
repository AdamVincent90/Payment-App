<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewListResource;
use Illuminate\Http\Request;
use App\Models\Book;

class ReviewListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        return ReviewListResource::collection($book->reviews()->latest()->get());
    }
}
