<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\OrderRequest;
use App\Models\Order;
use App\Repositories\BuyRequest\BuyRequestRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use App\Models\Staff;

class OrderController extends Controller
{
    protected BuyRequestRepositoryInterface $buyRequestRepo;
    protected OrderRepositoryInterface $orderRepo;
    protected $staff;

    public function __construct(
        BuyRequestRepositoryInterface $buyRequestRepo,
        OrderRepositoryInterface $orderRepo,
    ) {
        $this->buyRequestRepo = $buyRequestRepo;
        $this->orderRepo = $orderRepo;
        $this->staff = Auth::guard('staff')->user();
    }

    public function create(): View
    {
        $buyRequests = $this->buyRequestRepo->getAll();
        return view('staffs.order.order', compact('buyRequests'));
    }

// Xử lý dữ liệu khi chuyển qua cổng thanh toán Stripe
    public function store(OrderRequest $request)
    {
        $buyRequest = $this->buyRequestRepo->find($request->get('buy_request_id'));

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $productData = [
            'name' => $buyRequest->amount . ' Lượt xem',
        ];
        if ($buyRequest->discount > 0) {
            $productData['description'] ='Giảm:'.' '. $buyRequest->discount .'%';
        }
        // Khởi tạo đơn với thông tin giá , số lượng , staff_id và trạng thái chờ khi chuyển qua cổng Stripe
        $order = $this->orderRepo->create([
            'status' => 'waiting',
            'amount' => $buyRequest->amount,
            'price' => $buyRequest->price * ( 1 -  $buyRequest->discount/100 ),
            'staff_id' => Auth::guard('staff')->id()
        ]);
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'VND',
                    'product_data' => $productData,
                    'unit_amount' => $buyRequest->discountPrice ,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' =>route('staff.order.success', ['order_id' => $order->id]),
            'cancel_url' => route('staff.order.cancel', ['order_id' => $order->id]),
            'metadata' => [
                'staff_id' => $this->staff->id,
                'buy_request_id' => $buyRequest->id,
            ],
        ]);
        $this->orderRepo->update($order->id, ['checkout_session_id' => $session->id]);
        return redirect()->away($session->url);
    }

//    Xử lý dữ liệu khi thanh toán thành công
    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $orderId = $request->get('order_id');
        if (!empty($orderId)) {
            $order = Order::find($orderId);
            if (!empty($order->checkout_session_id)) {
                $session = \Stripe\Checkout\Session::retrieve($order->checkout_session_id);

                    //Chuyển trạng thái accepted nếu thanh toán thành công
                    if ($session->payment_status == 'paid') {
                        $order->status = 'accepted';
                        $order->save();
                    }
                    // Cộng lượt xem cho staff khi thanh toán thành công
                    $staff = Staff::find($order->staff_id);
                    if ($staff) {
                        $staff->view += $order->amount;
                        $staff->save();
                    }
                return redirect()->route('staff.order.create')->with('success', 'Đơn hàng của bạn đã được xử lý thành công !');
            }
        }
    }

    // Chuyển trạng thái rejected khi hủy giao dịch
    public function cancel(Request $request)
    {
        $orderId = $request->get('order_id');
        if (!empty($orderId)) {
            $order = Order::find($orderId);
            if ($order) {
                $order->status = 'rejected';
                $order->save();
            }
        }
        return redirect()->route('staff.order.create')->with('error', 'Giao dịch đã bị hủy, vui lòng thử lại !');

    }

    // Xử lý dữ liệu trả về lịch sử giao dịch
    public function history(): View
    {
        $data = $this->orderRepo->getHistoryOrder($this->staff->id);

        return view('staffs.order.history', [
            'orders' => $data['orders'],
            'orderCount' => $data['orderCount'],
        ]);
    }
}
