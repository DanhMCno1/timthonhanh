<?php

namespace App\Repositories\Staff;

use App\Models\Staff;
use App\Repositories\BaseRepository;

class StaffRepository extends BaseRepository implements StaffRepositoryInterface
{
    public function getModel()
    {
        return Staff::class;
    }
    public function getAll()
    {
        return $this->model
            ->orderBy('created_at')
            ->paginate(10);
    }
}
