<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Auth\SignUpRequest;
use App\Repositories\Otp\OtpRepositoryInterface;
use App\Repositories\Staff\StaffRepositoryInterface;
use App\Repositories\WorkArea\WorkAreaRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SignUpController extends Controller
{
    protected $staffRepo;
    protected $workAreaRepo;
    protected $otpRepo;

    public function __construct(
        StaffRepositoryInterface $staffRepo,
        WorkAreaRepositoryInterface $workAreaRepo,
        OtpRepositoryInterface $otpRepo
    ) {
        $this->staffRepo = $staffRepo;
        $this->workAreaRepo = $workAreaRepo;
        $this->otpRepo = $otpRepo;
    }

    public function create()
    {
        return view('staffs.auth.signup');
    }

    public function store(SignUpRequest $request)
    {
        $province_ids = $request->get('province_ids');
        $district_ids = $request->get('district_ids');
        $ward_ids = $request->get('ward_ids');
        $phone = $request->get('phone');
        $otp = $request->get('phone_otp');

        $validOtp = $this->otpRepo->getOtpNotExpired($phone, $otp);
        if (!$validOtp) {
            return response()->json([
                'errors' => ['error' => 'Mã xác thực không chính xác hoặc đã quá hạn.'],
            ], 500);
        }
        $this->otpRepo->delete($validOtp->id);

        try {
            DB::beginTransaction();

            // Auto create referral_code when sign-up successfully
            $referralCode = Str::upper(Str::random(10));

            // Tìm presenter_id nếu có mã giới thiệu
            $presenterId = null;
            $parentReferralCode = $request->get('present_code');
            if ($parentReferralCode) {
                $parentStaff = Staff::where('referral_code', $parentReferralCode)->first();
                if ($parentStaff) {
                    $presenterId = $parentStaff->id;
                } else {
                    return response()->json([
                        'errors' => ['error' => 'Mã giới thiệu không đúng hoặc không tồn tại.'],
                    ], 500);
                }
            }

            $staff = $this->staffRepo->create([
                'phone' => $phone,
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'referral_code' => $referralCode,
                'name' => $request->get('name'),
                'gender' => $request->get('gender'),
                'birthday' => $request->get('birthday'),
                'province_id' => $request->get('province_id'),
                'district_id' => $request->get('district_id'),
                'ward_id' => $request->get('ward_id'),
                'hamlet' => $request->get('hamlet'),
                'description' => $request->get('description'),
                'presenter_id' => $presenterId,
                'view' => $presenterId ? 10 : 5,
            ]);

            foreach ($province_ids as $key => $province_id) {
                $dataWorkArea = [
                    'staff_id' => $staff->id,
                    'province_id' => $province_id,
                    'district_id' => $district_ids[$key],
                ];
                if ($ward_ids[$key] != 0) {
                    $dataWorkArea['ward_id'] = $ward_ids[$key];
                }
                $this->workAreaRepo->create($dataWorkArea);
            }

            $workLists = json_decode($request->get('work_lists'));
            $staff->categories()->attach($workLists);

            $staff->image()->create([
                'path' => $request->file('image')->store('public/avatars'),
            ]);

            Auth::guard('staff')->login($staff);

            DB::commit();

            // Trả về thông báo phù hợp dựa vào việc có presenter_id hay không
            if ($presenterId) {
                return response()->json([
                    'success' => 'Bạn nhận thêm 5 lượt xem khi đăng ký với mã giới thiệu !',
                ]);
            } else {
                return response()->json([
                    'success' => 'Đăng ký thợ thành công.',
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Registration failed: ' . $e->getMessage());

            return response()->json([
                'errors' => ['error' => $e->getMessage()],
            ], 500);
        }
    }
}
