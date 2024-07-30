<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneRequest;
use App\Http\Requests\User\PasswordRequest;
use App\Models\User;
use App\Repositories\Otp\OtpRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ForgetPasswordController extends Controller
{
    protected $otpRepo;

    public function __construct(OtpRepositoryInterface $otpRepo)
    {
        $this->otpRepo = $otpRepo;
    }

    public function create(): View
    {
        return view('users.forget-password');
    }

    public function store(PhoneRequest $request): RedirectResponse
    {
        $phone = $request->get('phone');
        $otp = $request->get('phone_otp');

        $validOtp = $this->otpRepo->getOtpNotExpired($phone, $otp);

        if (!$validOtp) {
            return back()->with('error', 'Mã xác thực không chính xác hoặc đã quá hạn.')
                ->withInput();
        }

        $token = $validOtp->token;
        session(['token' => $token]);

        return redirect()->route('reset-password.edit', $token);
    }
}
