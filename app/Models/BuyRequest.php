<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'price',
        'discount'
    ];

    public function getDiscountPriceAttribute()
    {
        return (100 - $this->discount) * $this->price / 100;
    }
}
