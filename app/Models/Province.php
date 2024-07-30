<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';

    protected $fillable = [
        'name',
        'gso_id',
    ];

    public function districts()
    {
        return $this->hasMany(District::class,  'province_id');
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class, 'province_id');
    }

    public function workAreas()
    {
        return $this->hasMany(WorkArea::class, 'staff_id');
    }
}
