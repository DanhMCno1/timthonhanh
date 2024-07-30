<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use HasFactory;

    public $table = "staffs";

    protected $fillable = [
        'name',
        'status',
        'banned_until',
        'phone',
        'password',
        'email',
        'birthday',
        'gender',
        'description',
        'province_id',
        'district_id',
        'ward_id',
        'hamlet',
        'view',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'work_lists')
            ->withPivot('category_id', 'staff_id')
            ->orderBy('category_id', 'asc')
            ->withTimestamps();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function workAreas()
    {
        return $this->hasMany(WorkArea::class, 'staff_id');
    }

    public function getAreasAttribute()
    {
        return $this->workAreas()->get()->map(function ($workArea) {
            return [
                'province_id' => $workArea->province_id,
                'district_id' => $workArea->district_id,
                'ward_id' => $workArea->ward_id,
            ];
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'staff_id');
    }

    public function message()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'staff_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'staff_id');
    }

    public function getAverageRatingAttribute()
    {
        return round($this->feedbacks()->avg('rating'), 1);
    }

    public function messages(): MorphMany
    {
        return $this->morphMany(Message::class, 'sender');
    }
}
