<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        'payment_code',
        'merchant_transaction_id',
        'currency',
        'payment_type',
        'ndc',
        'amount',
        'payment_brand',
        'user_id',
        'created_at',
        'refunded'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }
}


