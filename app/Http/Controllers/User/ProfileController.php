<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Repositories\Otp\OtpRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected UserRepositoryInterface $userRepo;
    protected OtpRepositoryInterface $otpRepo;
    protected $user;

    public function __construct(UserRepositoryInterface $userRepo, OtpRepositoryInterface $otpRepo)
    {
        $this->userRepo = $userRepo;
        $this->otpRepo = $otpRepo;
        $this->user = Auth::user();
    }

    public function edit()
    {
        $user = $this->user;
        return view('users.profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $phone = $request->input('phone');
        $otp = $request->get('phone_otp');

        if($phone !== $this->user->phone) {
            $validOtp = $this->otpRepo->getOtpNotExpired($phone, $otp);
            if (!$validOtp) {
                return redirect()->back()->with('error', 'Mã xác thực không chính xác hoặc đã quá hạn.');
            }
            $this->otpRepo->delete($validOtp->id);
        }

        $data = $request->all();
        $this->userRepo->update($this->user->id, $data);

        return redirect()->route('user.home')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.home');
    }
}
