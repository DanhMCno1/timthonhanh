<?php

namespace App\Repositories\BuyRequest;

use App\Models\BuyRequest;
use App\Repositories\BaseRepository;

class BuyRequestRepository extends BaseRepository implements BuyRequestRepositoryInterface
{
    public function getModel(): string
    {
        return BuyRequest::class;
    }

    public function getAll()
    {
        return $this->model->orderBy('amount', 'asc')->get();
    }
}
