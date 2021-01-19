<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Resources\ReviewShowResource;
use App\Http\Resources\ReviewListResource;
use App\Models\Book;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->validate([
            'id' => 'required|size:36|unique:reviews',
            'name' => 'required',
            'content' => 'required|min:5',
            'rating' => 'required|in:1,2,3,4,5'
        ]);

        $booking = Book::findByReviewKey($request['id']);

        if($booking === null)
        {
            return abort(404);
        }

        $booking->review_key = "";
        $booking->save();

        $review = Review::make($request);
        $review->book_id = $booking->id;

        $review->save();

        return new ReviewListResource($review);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ReviewShowResource(Review::findOrFail($id));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
