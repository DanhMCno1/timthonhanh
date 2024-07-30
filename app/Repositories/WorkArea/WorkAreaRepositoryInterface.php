<?php

namespace App\Repositories\WorkArea;

use App\Repositories\RepositoryInterface;

interface WorkAreaRepositoryInterface extends RepositoryInterface
{
    public function updateOrCreate($staffId, $attributes = []);
}
