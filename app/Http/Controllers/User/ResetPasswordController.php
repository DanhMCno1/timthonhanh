<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordRequest;
use App\Models\User;
use App\Repositories\Otp\OtpRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    protected $otpRepo;

    public function __construct(OtpRepositoryInterface $otpRepo)
    {
        $this->otpRepo = $otpRepo;
    }

    public function edit($token)
    {
        if (session('token') !== $token) {
            return back()->with('error', 'Token không tồn tại.');
        }
        return view('users.reset-password', ['token' => $token]);
    }

    public function update(PasswordRequest $request)
    {
        $token = $request->get('token');
        $otpModel = $this->otpRepo->findByAttributes(['token' => $token]);
        if (!$otpModel) {
            return back()->with('error', 'Bạn không thể đổi mật khẩu.');
        }
        $receive_password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        if ($receive_password == $confirm_password) {
            $user = User::where('phone', $otpModel->phone)->first();
            $password = Hash::make($request->input('password'));
            $user->update(['password' => $password]);

            $this->otpRepo->delete($otpModel->id);
            session()->forget('token');

            return redirect()->route('signin')->with('success', 'Đổi mật khẩu thành công!');
        }

        return back()->with('error', 'Mật khẩu không khớp, vui lòng nhập lại!');
    }
}
