<?php

namespace App\Repositories\Otp;

use App\Models\Otp;
use App\Repositories\BaseRepository;

class OtpRepository extends BaseRepository implements OtpRepositoryInterface
{
    public function getModel()
    {
        return Otp::class;
    }

    public function getOtpNotExpired($phone, $otp)
    {
        return $this->model
            ->where('phone', $phone)
            ->where('otp', $otp)
            ->where('expired_at', '>', now())
            ->latest()
            ->first();
    }
}
