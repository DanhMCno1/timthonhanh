<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneRequest;
use App\Repositories\Otp\OtpRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class PhoneController extends Controller
{
    protected $otpRepo;

    public function __construct(OtpRepositoryInterface $otpRepo)
    {
        $this->otpRepo = $otpRepo;
    }

    public function sendOTP(PhoneRequest $request)
    {
        try {
            $otp = mt_rand(100000, 999999);
            $token = Str::random(60);
            $phone = $request->input('phone');
            $message = "Mã OTP của bạn là: $otp. Mã code sẽ hết hạn trong 15 phút";

            $this->otpRepo->create([
                'phone' => $phone,
                'otp' => $otp,
                'token' => $token,
                'expired_at' => now()->addMinutes(15),
            ]);

            $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            $client->messages->create(
                "+84" . substr($phone, 1),
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => $message
                ]
            );

            return response()->json(['message' => 'Mã xác thực đã được gửi đến số điện thoại']);
        } catch (TwilioException $e) {
            Log::error('Twilio error: ' . $e->getMessage());

            return response()->json(['message' => 'Có lỗi xảy ra khi gửi OTP'], 500);
        }
    }
}
