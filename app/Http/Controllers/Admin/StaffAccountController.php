<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Repositories\Staff\StaffRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffAccountController extends Controller
{
    protected StaffRepositoryInterface $staffRepository;

    public function __construct(StaffRepositoryInterface $staffRepository)

    {
        $this->staffRepository = $staffRepository;
    }
    public function index() {
        $staffs = $this->staffRepository->getAll();
        return view('admins.staffaccount', compact('staffs'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:active,block,foreverblock,unlock'],
        ], [
            'status.required' => 'Không có trạng thái.',
            'status.in' => 'Trạng thái không đúng.'
        ]);

        try {
            DB::beginTransaction();
            $status = $request->get('status');

            // Tìm đối tượng staff theo id
            $staff = Staff::findOrFail($id);

            if ($status === 'block') {
                $staff->update([
                    'status' => 'block',
                    'banned_until' => Carbon::now()->addDays(3)
                ]);
                $message = "Đã khóa tài khoản trong 3 ngày.";
            } elseif ($status === 'foreverblock') {
                $staff->update([
                    'status' => 'foreverblock',
                    'banned_until' => null
                ]);
                $message = "Đã khóa vĩnh viễn tài khoản.";
            } elseif ($status === 'unlock') {
                $staff->update([
                    'status' => 'active',
                    'banned_until' => null
                ]);
                $message = "Đã mở khóa tài khoản.";
            } else {
                $message = "Trạng thái không hợp lệ.";
            }

            DB::commit();

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', "Lỗi khi cập nhật trạng thái tài khoản #" . $id);
        }
    }
    public function unban($id)
    {
        $staff = Staff::find($id);
        if ($staff && $staff->status == 'block') {
            $staff->status = 'active';
            $staff->banned_until = null;
            $staff->save();

            return response()->json(['status' => 'success', 'message' => 'Staff unbanned successfully.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Staff not found or not banned.']);
    }
}
