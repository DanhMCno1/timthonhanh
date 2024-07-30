<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'province_id',
        'district_id',
        'ward_id',
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
        return $this->belongsTo(Ward::class)->withDefault();
    }
}
