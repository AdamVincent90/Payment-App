<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_title',
        'author',
        'release_date',
        'price'
    ];

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
