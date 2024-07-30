<?php

namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\BaseRepository;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function getModel(): string
    {
        return Message::class;
    }

    public function getMessagesByRequest($requestId, $quantity)
    {
        return $this->model
            ->where('request_id', $requestId)
            ->orderByDesc('created_at')
            ->take($quantity)
            ->get();
    }

    public function getMessageAndPaginate($requestId, $page) {
        return $this->model
            ->where('request_id', $requestId)
            ->orderByDesc('created_at')
            ->paginate(20, ['*'], 'page', $page);
    }
    
}
