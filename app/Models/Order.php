<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'amount',
        'price',
        'status',
        'checkout_session_id'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
