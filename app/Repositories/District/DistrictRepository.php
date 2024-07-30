<?php

namespace App\Repositories\District;

use App\Models\District;
use App\Repositories\BaseRepository;

class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    public function getModel()
    {
        return District::class;
    }

    public function getDistrictsByProvince($provinceId)
    {
        return $this->model->where('province_id', $provinceId)
            ->pluck('name', 'id')
            ->all();
    }
}
