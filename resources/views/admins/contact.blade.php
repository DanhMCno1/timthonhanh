<x-admin-layout>
    <x-slot name="header">
        Quản lý thông tin liên hệ
    </x-slot>

    <div class="space-y-4">
        <div class="font-bold text-2xl">Quản lý thông tin liên hệ</div>

        <div class="flex justify-center items-center">
            <form action="" method="get">
                <label for="hs-trailing-button-add-on-with-icon" class="sr-only">Label</label>
                <div class="flex rounded-lg shadow-sm">
                    <div class="relative">
                        <input type="text" value="{{ request('search') }}" name="search" class="py-3 px-4 ps-40 block w-full border-gray-200 shadow-sm rounded-l-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Tìm kiếm">
                        <div class="absolute inset-y-0 start-0 flex items-center text-gray-500 ps-px">
                            <select name="column" class="block w-full border-transparent border border-r-gray-200 rounded-l-lg focus:ring-blue-600 focus:border-blue-600">
                                <option {{ !request()->has('column') || request('column') === 'fullname' ? 'selected' : '' }} value="fullname">Họ và tên</option>
                                <option {{ request('column') === 'email' ? 'selected' : '' }} value="email">Email</option>
                                <option {{ request('column') === 'phone' ? 'selected' : '' }} value="phone">Số điện thoại</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="w-[2.875rem] h-[2.875rem] flex-shrink-0 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-md border border-transparent bg-blue-600 text-white hover:bg-blue-700">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-300">
                            <tr class="whitespace-nowrap">
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th scope="col" class="w-1/6 px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Họ và tên</th>
                                <th scope="col" class="px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Số điện thoại</th>
                                <th scope="col" class="w-5/12 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nội dung</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ngày tạo</th>
                                <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Hành động</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @foreach($contacts as $contact)
                                <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm font-medium text-gray-800">#{{ $contact->id }}</td>
                                    <td class="px-2 py-3 whitespace-nowrap text-start text-sm text-gray-800">{{ $contact->fullname }}</td>
                                    <td class="px-2 py-3 whitespace-nowrap text-start text-sm text-gray-800">{{ $contact->email }}</td>
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">{{ $contact->phone }}</td>
                                    <td class="px-2 py-3 w-72 text-start text-sm text-gray-800">
                                        <div class="line-clamp-2" onclick="this.classList.toggle('line-clamp-2')">
                                            {{ $contact->description }}
                                        </div>
                                    </td>
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">
                                        @switch($contact->status)
                                            @case(true)
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-green-200 text-green-800">Đã xử lý</span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs bg-blue-200 text-blue-800">Đang chờ xử lý</span>
                                        @endswitch
                                    </td>
                                    <td class="px-2 py-3 whitespace-nowrap text-center text-sm text-gray-800">{{ date_format($contact->created_at, 'd/m/Y H:i') }}</td>
                                    <td class="px-2 py-3">
                                        @if($contact->status === 0)
                                            <button onclick='event.preventDefault(); if (confirm("Bạn đã hoàn thành liên hệ này?")) this.nextElementSibling.submit()' class="whitespace-nowrap py-2 px-4 inline-flex items-center justify-center text-sm font-semibold rounded-lg border border-transparent text-green-600 bg-green-100 hover:bg-green-200">Hoàn thành</button>
                                            <form action="{{ route('admin.contacts.update', $contact) }}" class="flex-col lg:flex-row gap-1 flex justify-center" method="post">
                                                @csrf
                                                @method('PATCH')
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
            {{ $contacts->links('layouts.pagination', ['role' => 'staff']) }}
        </div>
    </div>
    <x-slot name="script">
        <script type="module">
            $(document).ready(function () {

            })
        </script>
    </x-slot>
</x-admin-layout>
