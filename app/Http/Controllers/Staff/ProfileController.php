<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\UpdateProfileRequest;
use App\Repositories\Otp\OtpRepositoryInterface;
use App\Repositories\Staff\StaffRepositoryInterface;
use App\Repositories\WorkArea\WorkAreaRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected StaffRepositoryInterface $staffRepo;
    protected OtpRepositoryInterface $otpRepo;
    protected WorkAreaRepositoryInterface $workAreaRepo;
    protected $staff;

    public function __construct(
        StaffRepositoryInterface $staffRepo,
        OtpRepositoryInterface $otpRepo,
        WorkAreaRepositoryInterface $workAreaRepo,
    ) {
        $this->staffRepo = $staffRepo;
        $this->otpRepo = $otpRepo;
        $this->workAreaRepo = $workAreaRepo;
        $this->staff = Auth::guard('staff')->user();
    }

    public function index(): View
    {
        return view('staffs.profile.index', ['staff' => $this->staff]);
    }

    public function edit(): View
    {
        return view('staffs.profile.edit', ['staff' => $this->staff]);
    }

    public function update(UpdateProfileRequest $request)
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

        if ($this->staff->id != $request->get('id')) {
            return response()->json([
                'errors' => ['error' => 'Bạn không có quyền đổi mật khẩu.'],
            ], 500);
        }

        try {
            DB::beginTransaction();
            $this->staffRepo->update($this->staff->id, [
                'phone' => $phone,
                'email' => $request->get('email'),
                'name' => $request->get('name'),
                'gender' => $request->get('gender'),
                'birthday' => $request->get('birthday'),
                'province_id' => $request->get('province_id'),
                'district_id' => $request->get('district_id'),
                'ward_id' => $request->get('ward_id'),
                'hamlet' => $request->get('hamlet'),
                'description' => $request->get('description'),
            ]);

            $dataWorkAreas = [];
            foreach ($province_ids as $key => $province_id) {
                $dataWorkAreas[] = [
                    'staff_id' => $this->staff->id,
                    'province_id' => $province_id,
                    'district_id' => $district_ids[$key],
                    'ward_id' => $ward_ids[$key] != 0 ? $ward_ids[$key] : null,
                ];
            }
            $this->workAreaRepo->updateOrCreate($this->staff->id, $dataWorkAreas);
            $workLists = json_decode($request->get('work_lists'));
            $this->staff->categories()->sync($workLists);

            if ($request->hasFile('image')) {
                Storage::delete($this->staff->image->path);
                $this->staff->image()->update([
                    'path' => $request->file('image')->store('public/avatars'),
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => 'Cập nhật thông tin thành công.',
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'errors' => ['error' => $e->getMessage()],
            ], 500);
        }
    }
}
