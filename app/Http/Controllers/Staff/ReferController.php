<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Staff\StaffRepository;

class ReferController extends Controller
{
    protected $staffRepo;
    protected $staff;

    public function __construct(StaffRepository $staffRepo)
    {
        $this->staffRepo = $staffRepo;
        $this->staff = Auth::guard('staff')->user();
    }
    public function index()
    {
        // Lấy danh sách người dùng có presenter_id trùng với ID tài khoản đang đăng nhập
        $referrals = $this->staffRepo->getReferralsByPresenterId($this->staff->id,1);

        if (Auth::guard('staff')->check()) {
            $staff = Auth::guard('staff')->user();

            // Đếm tổng số người dùng đã nhập mã giới thiệu
            $referralCount = $this->staffRepo->countReferralsByPresenterId($staff->id);

            return view('staffs.referral-code', [
                'referral_code' => $staff->referral_code,
                'referrals' => $referrals,
                'referralCount' => $referralCount
            ]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
