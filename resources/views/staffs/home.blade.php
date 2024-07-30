<x-staff-layout>
    <x-slot name="header">
        Trang chủ
    </x-slot>

    <div class="border mt-3 bg-white rounded">
        <div class="relative bg-gradient-to-b from-primary via-[#FBAD90] via-40% border-0 shadow rounded-t min-h-[150px]">
            <h2 class="font-bold flex items-center space-x-2 p-3 sm:p-4">
                <span>Số lần xem yêu cầu còn lại là:
                    <span class="text-white">{{ $staff->view }}</span> lượt
                </span>
            </h2>
            <div class="grid grid-cols-2 bottom-0 w-full mt-2 gap-3 sm:gap-4 p-3 sm:p-4">
                <a href="{{ route('staff.order.create') }}" class="flex items-center justify-center gap-2 bg-primary hover:bg-hover-primary duration-200 text-white text-sm h-8 px-4 font-bold rounded w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg> Mua thêm
                </a>
                <a href="{{ route('staff.order.history') }}" class="flex items-center justify-center gap-2 bg-[#1D2F43] hover:bg-black duration-200 text-white text-sm h-8 px-4 font-bold rounded w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg> Lịch sử
                </a>
            </div>
        </div>
    </div>


    <div class="mt-4 bg-white rounded min-h-[60vh]">
        <h2 class="font-bold p-3 sm:px-4 rounded-t-lg border-b flex justify-between items-center">
            <span>Danh sách yêu cầu đang chờ</span>
        </h2>
        <div class="p-3 sm:p-4 space-y-4">
            <nav class="space-x-2 overflow-x-auto max-w-full min-h-[40px] flex">
                <button type="button" class="text-xs font-bold text-primary border border-primary rounded-lg hover:text-white hover:bg-orange-700 py-[3px] px-2 inline-flex items-center gap-x-2 whitespace-nowrap duration-200 h-6 mb-1 active" id="tabs-item-0" role="tab" data-href="{{ route('staff.home', ['category_id' => 0]) }}">
                    Tất cả
                    <span class="text-white bg-primary inline-flex items-center justify-center w-4 h-4 rounded-full text-xs font-bold duration-200">{{ $staff->requests->count() }}</span>
                </button>
                @foreach($categories as $category)
                    <button type="button" class="text-xs font-bold border rounded-lg hover:text-white py-[3px] px-2 inline-flex items-center gap-x-2 whitespace-nowrap duration-200 h-6 mb-1 text-black border-black hover:bg-black" id="tabs-item-{{ $category->id }}" role="tab" data-href="{{ route('staff.home', ['category_id' => $category->id]) }}">
                        {{ $category->name }}
                        <span class="bg-dark-blue text-white hs-tab-active:bg-primary inline-flex items-center justify-center w-4 h-4 rounded-full text-xs font-bold duration-200">{{ $category->total }}</span>
                    </button>
                @endforeach
            </nav>

            <div id="request-list" class="mt-3"></div>
        </div>

    </div>
    @vite('resources/js/staff/home.js')
</x-staff-layout>
