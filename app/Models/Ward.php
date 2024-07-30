<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';

    protected $fillable = [
        'name',
        'gso_id',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class, 'ward_id');
    }

    public function workAreas()
    {
        return $this->hasMany(WorkArea::class, 'staff_id');
    }
}
