<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookByReviewKeyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'book_id' => $this->id,
            'author' => $this->author,
            'book_title' => $this->book_title,
            'description' => $this->description

        ];
    }
}
