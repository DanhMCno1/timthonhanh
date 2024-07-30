<?php

namespace App\Repositories\Ward;

use App\Models\Ward;
use App\Repositories\BaseRepository;

class WardRepository extends BaseRepository implements WardRepositoryInterface
{
    public function getModel()
    {
        return Ward::class;
    }

    public function getWardsByDistrict($districtId)
    {
        return $this->model->where('district_id', $districtId)
            ->pluck('name', 'id')
            ->all();
    }
}
