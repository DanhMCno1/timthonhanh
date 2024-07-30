<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre_id'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function staffs()
    {
        return $this->belongsToMany(Staff::class, 'work_lists')
            ->withPivot('category_id', 'staff_id')
            ->orderBy('category_id', 'asc')
            ->withTimestamps();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
