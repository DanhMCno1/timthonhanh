<x-admin-layout>
    <x-slot name="header">
        Quản lý đơn mua
    </x-slot>
    <div>
        <div class="font-bold text-2xl">Quản lý đơn mua</div>
        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-300">
                                <tr>
                                    <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th scope="col" class="px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Họ và tên</th>
                                    <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Số điện thoại</th>
                                    <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Số lượng</th>
                                    <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Thanh toán</th>
                                    <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                    <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ngày thanh toán</th>
                                    <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach($orders as $order)
                                    <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                                        <td class="px-2 py-3 whitespace-nowrap text-center text-sm font-medium text-gray-800">#{{ $order->id }}</td>
                                        <td class="px-2 py-3 text-sm text-gray-800">
                                            <div class="max-w-44 line-clamp-1" title="{{ $order->staff->name }}">{{ $order->staff->name }}</div>
                                        </td>
                                        <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">{{ $order->staff->phone }}</td>
                                        <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">{{ $order->amount }}</td>
                                        <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">{{ number_format($order->price, 0, '', ',') }}₫</td>
                                        <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">
                                            @switch($order->status)
                                                @case('accepted')
                                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-green-200 text-green-800">Thành công</span>
                                                    @break
                                                @case('rejected')
                                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-red-200 text-red-800">Đã hủy</span>
                                                    @break
                                                @default
                                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-blue-200 text-blue-800">Đang chờ</span>
                                            @endswitch
                                        </td>
                                        <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">{{ date_format($order->created_at, 'd/m/Y H:i') }}</td>
                                        <td class="px-2 py-3">
                                            @if($order->status === 'waiting')
                                                <form action="{{ route('admin.orders.update', $order->id) }}" class="flex-col lg:flex-row gap-1 flex justify-center" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" data-id="{{ $order->id }}" value="">
                                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                                    <button type="button" onclick="setStatus(this, {{ $order->id }}, 'accepted')" class="whitespace-nowrap py-1 px-2 inline-flex items-center justify-center text-sm font-semibold rounded-lg border border-transparent text-green-600 bg-green-100 hover:bg-green-200">
                                                        Chấp nhận
                                                    </button>
                                                    <button type="button" onclick="setStatus(this, {{ $order->id }}, 'rejected')" class="whitespace-nowrap py-1 px-2 inline-flex items-center justify-center text-sm font-semibold rounded-lg border border-transparent text-red-500 bg-red-100 hover:bg-red-200">
                                                        Từ chối
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $orders->links('layouts.pagination', ['role' => 'staff']) }}
        </div>
    </div>

    <x-slot name="script">
        <script type="module">
            $(document).ready(function () {
                function setStatus(element, id, status) {
                    let message = status === 'accepted' ? 'Bạn chắc chắn chấp nhận đơn mua?': 'Bạn chắc chắn từ chối đơn mua?';
                    if(confirm(message)) {
                        $(`input[name="status"][data-id=${id}]`).val(status);
                        $(element).parent('form').submit();
                    }
                }
                window.setStatus = setStatus;
            })
        </script>
    </x-slot>
</x-admin-layout>
