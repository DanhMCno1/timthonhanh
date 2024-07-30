<x-staff-layout>
    <x-slot name="header">
        Mua yêu cầu công việc
    </x-slot>
    <div class="border min-h-[80vh] my-3 py-3 bg-white rounded-lg ">
        <h1 class="p-4 px-5 rounded-t-lg border-b text-lg flex justify-between items-center">
            <b>Lịch sử mua yêu cầu
                <span class="text-sm">({{ $orderCount}})</span>
            </b>
            <a href="{{ route('staff.order.create') }}" class="font-bold text-white px-2 border-x border-primary py-1 text-xs rounded-lg bg-primary">
                Mua thêm
            </a>
        </h1>
        <div class="p-4">
            @foreach($orders as $order)
                <div class="p-3 mt-1 bg-[#FEF6F3] rounded">
                    <div class="mb-2">
                        <span class="font-extrabold">#{{ $order->id }}</span>
                        Mua <b class="text-primary">{{ $order->amount }}</b> yêu cầu công việc
                    </div>
                    <div class="text-sm">
                        Số tiền thanh toán: {{ number_format($order->price, 0, '', '.') }}₫
                    </div>
                    <div class="flex justify-between">
                            @switch($order->status)
                                @case('accepted')
                                    <span class="text-xs text-green-800 bg-green-200">Thành công</span>
                                    @break
                                @case('waiting')
                                    <span class="text-xs text-blue-800 bg-blue-200">Đang chờ</span>
                                    @break
                                @case('rejected')
                                    <span class="text-xs text-red-800 bg-red-200">Đã hủy</span>
                                    @break
                            @endswitch
                        <div class="text-xs">{{ date_format($order->created_at, 'd/m/Y H:i') }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $orders->links('layouts.pagination', ['role' => 'staff']) }}
    </div>
</x-staff-layout>
