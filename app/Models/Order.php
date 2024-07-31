<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'presenter_id',
        'amount',
        'price',
        'status',
        'checkout_session_id'
    ];

    public function staff() : BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
    public function presenter(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'presenter_id');
    }
}
