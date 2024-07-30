<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'gso_id',
        'province_id',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function wards()
    {
        return $this->hasMany(Ward::class, 'district_id');
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class, 'district_id');
    }

    public function workAreas()
    {
        return $this->hasMany(WorkArea::class, 'staff_id');
    }
}
