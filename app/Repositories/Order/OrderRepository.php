<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel(): string
    {
        return Order::class;
    }

    public function getHistoryOrder($staffId)
    {
        // Lấy tất cả các đơn hàng mà staff là người mua hoặc là người giới thiệu
        $orders = $this->model::where('staff_id', $staffId)
            ->orderByDesc('created_at')
            ->paginate(5);

        // Đếm số lượng đơn hàng mà staff là người mua hoặc là người giới thiệu
        $orderCount = $this->model::where('staff_id', $staffId)
            ->count();

        return [
            'orders' => $orders,
            'orderCount' => $orderCount,
        ];
    }

    public function getAll()
    {
        return $this->model
            ->with('staff', 'presenter') // Include both staff and presenter relationships
            ->orderByDesc('created_at')
            ->paginate(10);
    }
    public function getPresenterBonuses($presenterId)
    {
        // Lấy tất cả các đơn hàng mà người dùng hiện tại là presenter
        $bonuses = $this->model::where('presenter_id', $presenterId)
            ->with(['staff' => function($query) {
                $query->select('id', 'name');
            }])
            ->orderByDesc('created_at')
            ->get();

        return $bonuses;
    }
}
