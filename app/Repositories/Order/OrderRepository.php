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
        $orders = $this->model::where('staff_id', $staffId)
            ->orderByDesc('created_at')
            ->paginate(5);

        $orderCount = $this->model::where('staff_id', $staffId)->count();

        return [
            'orders' => $orders,
            'orderCount' => $orderCount,
            ];
    }

    public function getAll()
    {
        return $this->model
            ->with('staff')
            ->orderByDesc('created_at')
            ->paginate(10);
    }
}
