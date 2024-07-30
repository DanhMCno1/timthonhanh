<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use App\Repositories\Request\RequestRepositoryInterface;
use App\Repositories\Staff\StaffRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    protected RequestRepositoryInterface $requestRepo;
    protected StaffRepositoryInterface $staffRepo;

    public function __construct(RequestRepositoryInterface $requestRepo, StaffRepositoryInterface $staffRepo)
    {
        $this->requestRepo = $requestRepo;
        $this->staffRepo = $staffRepo;
    }

    public function show(ModelsRequest $request)
    {
        if ($request->staff_id !== auth('staff')->user()->id) {
            return redirect(route('staff.home'))->with('error', 'Bạn không có quyền xem yêu cầu này.');
        }

        return view('staffs.request.show', compact('request'));
    }

    public function update(ModelsRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $staff = $this->staffRepo->find($request->staff_id);

            $request->update(['status' => true]);
            $staff->update(['view' => $staff->view - 1]);

            DB::commit();

            return redirect()->route('staff.requests.show', $request);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();

            return redirect()->route('staff.requests.show', $request)
                ->with("error", "Lỗi xem thông tin yêu cầu");
        }
    }
}
