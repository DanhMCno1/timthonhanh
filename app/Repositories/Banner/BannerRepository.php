<?php

namespace App\Repositories\Banner;

use App\Models\Banner;
use App\Repositories\BaseRepository;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    public function getModel(): string
    {
        return Banner::class;
    }
}
