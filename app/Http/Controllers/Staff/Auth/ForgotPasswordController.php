<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneRequest;
use App\Repositories\Otp\OtpRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    protected $otpRepo;

    public function __construct(OtpRepositoryInterface $otpRepo)
    {
        $this->otpRepo = $otpRepo;
    }


    public function create(): View
    {
        return view('staffs.auth.forgot-password');
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

        return redirect()->route('staff.reset-password.edit', $token);
    }
}
