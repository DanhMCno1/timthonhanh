<?php

namespace App\Repositories\Request;

use App\Repositories\RepositoryInterface;

interface RequestRepositoryInterface extends RepositoryInterface
{
    public function getRequestByUser($userId);
    public function getRequestHasMessage();
}
