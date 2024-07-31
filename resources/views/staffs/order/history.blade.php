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
            <div class="p-3 mt-1 bg-[#FEF6F3] rounded">
                <div class="mb-2">
                    Tặng <b class="text-primary">5</b> lượt xem
                </div>
                <div class="text-sm flex mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1"><path d="M190.5 68.8L225.3 128l-1.3 0-72 0c-22.1 0-40-17.9-40-40s17.9-40 40-40l2.2 0c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40L32 128c-17.7 0-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32l448 0c17.7 0 32-14.3 32-32l0-64c0-17.7-14.3-32-32-32l-41.6 0c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88l-2.2 0c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0L152 0C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40l-72 0-1.3 0 34.8-59.2C329.1 55.9 342.9 48 357.8 48l2.2 0c22.1 0 40 17.9 40 40zM32 288l0 176c0 26.5 21.5 48 48 48l144 0 0-224L32 288zM288 512l144 0c26.5 0 48-21.5 48-48l0-176-192 0 0 224z"/></svg>
                    Quà tặng khi đăng ký tài khoản thành công
                </div>
                <div class="flex justify-between">
                    <span class="text-xs text-green-800 bg-green-200">Thành công</span>
                    <div class="text-xs">{{ date_format($staff->created_at, 'd/m/Y H:i') }}</div>
                </div>
            </div>
            @if(!empty($staff->presenter_id))
                <div class="p-3 mt-1 bg-[#FEF6F3] rounded">
                    <div class="mb-2">
                        Tặng <b class="text-primary">5</b> lượt xem
                    </div>
                    <div class="text-sm flex mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1"><path d="M190.5 68.8L225.3 128l-1.3 0-72 0c-22.1 0-40-17.9-40-40s17.9-40 40-40l2.2 0c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40L32 128c-17.7 0-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32l448 0c17.7 0 32-14.3 32-32l0-64c0-17.7-14.3-32-32-32l-41.6 0c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88l-2.2 0c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0L152 0C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40l-72 0-1.3 0 34.8-59.2C329.1 55.9 342.9 48 357.8 48l2.2 0c22.1 0 40 17.9 40 40zM32 288l0 176c0 26.5 21.5 48 48 48l144 0 0-224L32 288zM288 512l144 0c26.5 0 48-21.5 48-48l0-176-192 0 0 224z"/></svg>
                        Quà tặng khi nhập mã giới thiệu
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-green-800 bg-green-200">Thành công</span>
                        <div class="text-xs">{{ date_format($staff->created_at, 'd/m/Y H:i') }}</div>
                    </div>
                </div>
            @endif

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

            {{-- Hiển thị thông tin bonus --}}
            @if($bonuses->isNotEmpty())
                <div class="">
                    @foreach($bonuses as $bonus)
                        <div class="p-3 mt-1 bg-[#FEF6F3] rounded">
                            <div class="mb-2">
                                Tặng thêm <b class="text-primary">{{ $bonus->amount * 0.2 }}</b> lượt xem từ
                                <span class="ml-1 font-extrabold">{{ $bonus->staff->name }}</span>
                            </div>
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1"><path d="M190.5 68.8L225.3 128l-1.3 0-72 0c-22.1 0-40-17.9-40-40s17.9-40 40-40l2.2 0c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40L32 128c-17.7 0-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32l448 0c17.7 0 32-14.3 32-32l0-64c0-17.7-14.3-32-32-32l-41.6 0c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88l-2.2 0c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0L152 0C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40l-72 0-1.3 0 34.8-59.2C329.1 55.9 342.9 48 357.8 48l2.2 0c22.1 0 40 17.9 40 40zM32 288l0 176c0 26.5 21.5 48 48 48l144 0 0-224L32 288zM288 512l144 0c26.5 0 48-21.5 48-48l0-176-192 0 0 224z"/></svg>
                                Thưởng khi chia sẻ mã giới thiệu
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-green-800 bg-green-200">Thành công</span>
                                <div class="text-xs">{{ date_format($bonus->created_at, 'd/m/Y H:i') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        {{ $orders->links('layouts.pagination', ['role' => 'staff']) }}
    </div>
</x-staff-layout>
