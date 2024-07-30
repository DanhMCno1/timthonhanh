<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected OrderRepositoryInterface $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function index(): View
    {
        $orders = $this->orderRepo->getAll();
        return view('admins.orders', compact('orders'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:accepted,rejected'],
        ], [
            'status.required' => 'Không có trạng thái.',
            'status.in' => 'Trạng thái không đúng.'
        ]);
        try {
            DB::beginTransaction();
            $status = $request->get('status');
            $staff = $order->staff;

            $order->update(['status' => $status]);

            if ($status === 'accepted') {
                $staff->update(['view' => $staff->view + $order->amount]);
                $message = "Đã chấp nhận yêu cầu mua #". $request->id;
            } else {
                $message = "Đã từ chối yêu cầu mua #". $request->get('id');
            }

            DB::commit();

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', "Lỗi thay đổi trạng thái đơn hàng #". $request->get('id'));
        }
    }
}
