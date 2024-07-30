<?php

namespace App\Repositories\Message;

use App\Repositories\RepositoryInterface;

interface MessageRepositoryInterface extends RepositoryInterface
{
    public function getMessagesByRequest($requestId, $quantity);
    public function getMessageAndPaginate($requestId, $page);
}
