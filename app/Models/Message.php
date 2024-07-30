<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'sender_id',
        'sender_type',
        'message',
    ];

    public function sender(): MorphTo
    {
        return $this->morphTo();
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class, 'request_id');
    }
}
