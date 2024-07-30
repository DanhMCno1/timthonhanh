<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\District\DistrictRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\Ward\WardRepositoryInterface;

class LocationController extends Controller
{
    protected $provinceRepo;
    protected $districtRepo;
    protected $wardRepo;

    public function __construct(
        ProvinceRepositoryInterface $provinceRepo,
        DistrictRepositoryInterface $districtRepo,
        WardRepositoryInterface $wardRepo
    )
    {
        $this->provinceRepo = $provinceRepo;
        $this->districtRepo = $districtRepo;
        $this->wardRepo = $wardRepo;
    }

    public function getAllProvinces()
    {
        return $this->provinceRepo->getProvinces();
    }

    public function getDistrictsByProvince($province_id)
    {
        return $this->districtRepo->getDistrictsByProvince($province_id);
    }

    public function getWardsByDistrict($district_id)
    {
        return $this->wardRepo->getWardsByDistrict($district_id);
    }
}
