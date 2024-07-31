<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'summary',
        'content',
        'status'
    ];
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
