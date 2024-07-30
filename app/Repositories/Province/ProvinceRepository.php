<?php

namespace App\Repositories\Province;

use App\Models\Province;
use App\Repositories\BaseRepository;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    public function getModel()
    {
        return Province::class;
    }

    public function getProvinces()
    {
        return $this->model->pluck('name', 'id')->all();
    }
}
