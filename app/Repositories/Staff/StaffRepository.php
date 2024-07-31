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
    public function getReferralsByPresenterId($presenterId)
    {
        return Staff::where('presenter_id', $presenterId)
            ->select('id', 'name')
            ->orderBy('id')
            ->paginate(10);
    }
    public function countReferralsByPresenterId($presenterId)
    {
        return Staff::where('presenter_id', $presenterId)->count();
    }
}
