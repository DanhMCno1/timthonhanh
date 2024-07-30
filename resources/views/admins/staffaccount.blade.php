<x-admin-layout>
    <x-slot name="header">
        Quản lý tài khoản thợ
    </x-slot>
    <div>
        <div class="font-bold text-2xl">Quản lý tài khoản thợ</div>
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
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ngày tạo</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Quản lý</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach($staffs as $staff)
                                <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm font-medium text-gray-800">#{{ $staff->id }}</td>
                                    <td class="px-2 py-3 text-sm text-gray-800">
                                        <div class="max-w-44 line-clamp-1" title="{{ $staff->name }}">{{ $staff->name }}</div>
                                    </td>
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">{{ $staff->phone }}</td>
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">
                                        @switch($staff->status)
                                            @case('block')
                                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-red-200 text-red-800" id="countdown-{{ $staff->id }}"></span>
                                                @break
                                            @case('foreverblock')
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-red-200 text-red-800">Khoá vĩnh viễn</span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-green-200 text-green-800">Hoạt Động</span>
                                        @endswitch
                                    </td>
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">{{ date_format($staff->created_at, 'd/m/Y') }}</td>
                                    <td class="px-2 py-3">
                                        @if($staff->status === 'active')
                                            <form action="{{ route('admin.staffaccount.update', $staff->id) }}" class="flex-col lg:flex-row gap-1 flex justify-center" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" data-id="{{ $staff->id }}" value="">
                                                <input type="hidden" name="id" value="{{ $staff->id }}">
                                                <button type="button" onclick="setStatus(this, {{ $staff->id }}, 'block')" class="whitespace-nowrap py-1 px-2 inline-flex items-center justify-center text-sm rounded-lg border border-transparent font-semibold text-white bg-blue-500 hover:bg-blue-700"
                                                > Khóa 3 ngày
                                                </button>
                                                <button type="button" onclick="setStatus(this, {{ $staff->id }}, 'foreverblock')" class="whitespace-nowrap py-1 px-2 inline-flex items-center justify-center text-sm rounded-lg border border-transparent font-semibold text-white bg-blue-500 hover:bg-blue-700"
                                                > Khóa vĩnh viễn
                                                </button>
                                            </form>
                                            @else
                                                <form action="{{ route('admin.staffaccount.update', $staff->id) }}" class="flex-col lg:flex-row gap-1 flex justify-center" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" data-id="{{ $staff->id }}" value="">
                                                    <input type="hidden" name="id" value="{{ $staff->id }}">
                                                    <button type="button" onclick="setStatus(this, {{ $staff->id }}, 'unlock')" class="whitespace-nowrap py-1 px-2 inline-flex items-center justify-center text-sm font-semibold rounded-lg border border-transparent text-white bg-blue-500 hover:bg-blue-700"
                                                    > Mở khóa
                                                    </button>
                                                </form>
                                            @if($staff->banned_until)
                                                    <script>
                                                    var countDownDate{{ $staff->id }} = new Date("{{ $staff->banned_until }}").getTime();
                                                    var x = setInterval(function() {
                                                        var now = new Date().getTime();
                                                        var distance = countDownDate{{ $staff->id }} - now;

                                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                        document.getElementById("countdown-{{ $staff->id }}").innerHTML ="Tạm khóa còn:" + ' ' + days + "d " + hours + "h "
                                                            + minutes + "m " + seconds + "s ";

                                                        if (distance < 0) {
                                                            clearInterval(x);
                                                            document.getElementById("countdown-{{ $staff->id }}").innerHTML = "EXPIRED";
                                                            $.ajax({
                                                                url: '{{ route('staff.unban', $staff->id) }}',
                                                                type: 'POST',
                                                                data: {
                                                                    _token: '{{ csrf_token() }}'
                                                                },
                                                                success: function(response) {
                                                                    if (response.status === 'success') {
                                                                        location.reload();
                                                                    } else {
                                                                        document.getElementById("countdown-{{ $staff->id }}").innerHTML = "ERROR";
                                                                    }
                                                                },
                                                                error: function() {
                                                                    document.getElementById("countdown-{{ $staff->id }}").innerHTML = "ERROR";
                                                                }
                                                            });
                                                        }
                                                    }, 1000);
                                                </script>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $staffs->links('layouts.pagination', ['role' => 'staff']) }}
        </div>
    </div>

    <x-slot name="script">
        <script type="module">
            $(document).ready(function () {
                function setStatus(element, id, status) {
                    const message = status === 'unlock' ? 'Bạn chắc chắn mở khóa tài khoản này?' : (status === 'block' ? 'Bạn chắc chắn khóa 3 ngày với tài khoản này?' : 'Bạn chắc chắn khóa vĩnh viễn tài khoản này?');

                    if (confirm(message)) {
                        element.closest('form').querySelector('input[name="status"]').value = status;
                        element.closest('form').submit();
                    }
                }
                window.setStatus = setStatus;
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </x-slot>
</x-admin-layout>
