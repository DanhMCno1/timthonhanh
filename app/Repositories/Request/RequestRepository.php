<?php

namespace App\Repositories\Request;

use App\Models\Request;
use App\Repositories\BaseRepository;

class RequestRepository extends BaseRepository implements RequestRepositoryInterface
{
    public function getModel(): string
    {
        return Request::class;
    }

    public function getRequestByUser($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function getRequestHasMessage()
    {
        return $this->model->has('messages')->get();
    }
}
