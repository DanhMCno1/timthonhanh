<?php

namespace App\Repositories\Otp;

use App\Repositories\RepositoryInterface;

interface OtpRepositoryInterface extends RepositoryInterface
{
    public function getOtpNotExpired($phone, $otp);
}
