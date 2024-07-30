<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Auth\ResetPasswordRequest;
use App\Repositories\Otp\OtpRepositoryInterface;
use App\Repositories\Staff\StaffRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    protected $staffRepo;
    protected $otpRepo;

    public function __construct(StaffRepositoryInterface $staffRepo, OtpRepositoryInterface $otpRepo)
    {
        $this->staffRepo = $staffRepo;
        $this->otpRepo = $otpRepo;
    }

    public function edit($token)
    {
        if (session('token') !== $token) {
            return back()->with('error', 'Token không tồn tại.');
        }

        return view('staffs.auth.reset-password', ['token' => $token]);
    }

    public function update(ResetPasswordRequest $request)
    {
        $token = $request->get('token');
        $otpModel = $this->otpRepo->findByAttributes(['token' => $token]);
        if (!$otpModel) {
            return back()->with('error', 'Bạn không thể đổi mật khẩu.');
        }

        $staff = $this->staffRepo->findByAttributes(['phone' => $otpModel->phone]);
        $this->staffRepo->update($staff->id, [
            'password' => Hash::make($request->get('password'))
        ]);

        $this->otpRepo->delete($otpModel->id);
        session()->forget('token');

        return redirect()->route('staff.signin.create')->with('success', 'Đổi mật khẩu thành công.');
    }
}
