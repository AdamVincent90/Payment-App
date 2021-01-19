<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_title',
        'author',
        'release_date',
        'price'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    //Create static function to find this class review key by the paramate in route url

    public static function findByReviewKey(string $key): ?Book 
    {
        return static::where('review_key', $key)->get()->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function($book) {
            $book->review_key = Str::uuid();
        });
    }
}
