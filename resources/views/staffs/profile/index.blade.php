<x-staff-layout>
    <x-slot name="header">
        Trang cá nhân
    </x-slot>

    <div class="border rounded-t-md min-h-[80vh] mt-3 bg-white shadow rounded relative">
        <div class="p-4 pb-0">
            <div class="absolute top-[5px] right-[10px]">
                <a href="/s/edit" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
                    </svg>
                </a>
            </div>
            <div class="flex items-center justify-center">
                <div>
                    <img class="flex items-center justify-center w-[100px] h-[100px] border bg-gray-600 rounded-full" src="{{ Storage::url($staff->image->path) }}" alt="">
                </div>
            </div>
            <div>
                <div class="text-xl font-bold text-center flex items-center justify-center space-x-1">
                    <span>{{ $staff->name }}</span>
                    <button class="hover:bg-gray-300 hover:text-[#ffbe00] duration-300 p-1 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="text-sm">
                <p class="break-words line-clamp-3 text-pretty">{{ $staff->description }}</p>
            </div>
            <div class="mt-5 mb-2">
                <div class="flex items-center space-x-1">
                    <span class="font-bold">Khu vực hoạt động</span>
                </div>
                <div class="py-2 grid grid-cols-1 gap-1">
                    @foreach($staff->workAreas as $work_area)
                        <div class="p-1 rounded flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"></path>
                            </svg>
                            <span class="text-xs">{{ $work_area->district->name }}, {{ $work_area->province->name }}</span></div>
                    @endforeach
                </div>
            </div>
            <div class="mt-5 mb-2">
                <div class="flex items-center space-x-1">
                    <span class="font-bold">Danh mục công việc</span>
                </div>
                <div class="py-2 grid grid-cols-3 gap-1">
                    @foreach($staff->categories as $category)
                        <div class="border p-1 rounded text-center space-x-1">
                            <span class="text-xs line-clamp-1">{{ $category->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="border-gray-200 my-4 border-1">
        <div class="px-4 pb-1">
            <div class="font-bold text-base">
                <span>Đánh giá</span>
            </div>
            <div class="py-3 flex space-x-2">
                <!-- Rating -->
                <div class="flex items-center">
                    <svg class="flex-shrink-0 size-4 text-orange-100" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                    <svg class="flex-shrink-0 size-4 text-orange-100" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                    <svg class="flex-shrink-0 size-4 text-orange-100" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                    <svg class="flex-shrink-0 size-4 text-orange-100" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                    <svg class="flex-shrink-0 size-4 text-orange-100" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                </div>
                <span>
                    <span class="text-orange-400 font-bold">0.0</span>
                    <span class="ms-1 text-xs">(0 đánh giá)</span>
                </span>
            </div>
            <div class="pb-5">Chưa có đánh giá nào.</div>
        </div>
    </div>
</x-staff-layout>
