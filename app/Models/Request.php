<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staff_id',
        'category_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function messages() 
    {
        return $this->hasMany(Message::class, 'request_id');
    }
}
