<x-user-layout>
<x-slot name="header">
    Tìm kiếm thợ
</x-slot>
    {{--Thẻ hiển thị thông báo đăng ký thành công/thất bại--}}
    <div id="message" class="hidden p-4 rounded-3xl text-center"><i class="fa-regular fa-circle-xmark"></i></div>
    {{--Form signup--}}
    <div class="border shadow-md p-4 rounded-md mb-6 bg-white">
        <div class="flex mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-blue-700 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
            </svg>
            <span class="text-blue-700 font-bold ml-1">Tìm kiếm theo danh mục</span>
        </div>
        <div class="cursor-pointer">
            <button type="button" class="flex justify-between border w-full hover:bg-gray-200 font-bold rounded-lg
            text-sm px-4 py-3 mb-5 dark:bg-blue-500 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-500"
                    data-hs-overlay="#hs-overlay-category-searching"  data-category-id="{{ request()->get('category_id', '') }}" >
                    <p>
                    @php
                        if (request()->has('category_id') && request()->get('category_id') != '') {
                            echo $categories[$_GET['category_id']];
                        } else {
                            echo "Bạn muốn tìm thợ gì?";
                        }
                    @endphp
                    </p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
                </svg>
            </button>
        </div>
        <div class="cursor-pointer">
            <button type="button" class="flex justify-between border w-full hover:bg-gray-200 font-bold rounded-lg
            text-sm px-4 py-3 mb-5 dark:bg-blue-500 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-500"
                    data-hs-overlay="#hs-overlay-area">
                <div class="flex">
                    <svg class="w-6 h-6" viewBox="-15.36 -15.36 542.72 542.72" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000" transform="rotate(0)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><g id="Page-1" stroke-width="0.00512" fill="none" fill-rule="evenodd"><g id="location-outline" fill="#000000" transform="translate(106.666667, 42.666667)"><path d="M149.333333,7.10542736e-15 C231.807856,7.10542736e-15 298.666667,66.8588107 298.666667,149.333333 C298.666667,176.537017 291.413333,202.026667 278.683512,224.008666 C270.196964,238.663333 227.080238,313.32711 149.333333,448 C71.5864284,313.32711 28.4697022,238.663333 19.9831547,224.008666 C7.25333333,202.026667 2.84217094e-14,176.537017 2.84217094e-14,149.333333 C2.84217094e-14,66.8588107 66.8588107,7.10542736e-15 149.333333,7.10542736e-15 Z M149.333333,85.3333333 C113.987109,85.3333333 85.3333333,113.987109 85.3333333,149.333333 C85.3333333,184.679557 113.987109,213.333333 149.333333,213.333333 C184.679557,213.333333 213.333333,184.679557 213.333333,149.333333 C213.333333,113.987109 184.679557,85.3333333 149.333333,85.3333333 Z" id="Combined-Shape"></path></g></g></g>
                    </svg>
                    <span class="ml-2" id="display-area">Chọn khu vực</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
                </svg>
            </button>
        </div>
{{-- Hiển thị thông tin từng thợ --}}
        <div id="list-staffs">
            @if(request()->has('category_id') && request()->get('category_id') != '')
                @if(isset($staffCount)&& $staffCount > 0)
                    <span class="flex justify-end mb-4 font-semibold">Tổng {{$staffCount}} thợ</span>
                @else
                    <span class="flex justify-end mb-4 font-semibold">Tổng 0 thợ</span>
                    <div class="text-center min-h-[350px] pt-10">
                        Không tìm thấy thợ nào
                    </div>
                @endif
                @foreach ($staffs as $profile)
                    <div class="border rounded-xl overflow-hidden mb-4">
                        <div class="border-b flex ">
                            <div class="overflow-hidden w-[140px] h-[100px] bg-gray-200 m-4 rounded-xl border">
                                <img class="w-full h-full" src="{{ Storage::url($profile->image->path) }}">
                            </div>
                            <div class="w-full">
                                <div class="my-4">
                                    <p class="text-lg font-semibold">{{$profile->name}}</p>
                                    <span class="text-sm">{{$profile->description}}</span>
                                    <div class="flex">
                                        <div class="flex my-2 align-middle">
                                            @for ($i = 0; $i < 5; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[10px] h-[10px] text-orange-500">
                                                    <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        <p class="text-sm mx-1 pt-0.5">5.0</p>
                                        <p class="text-sm pt-0.5">(1 đánh giá)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex h-10">
                            <button type="button" class="w-1/2 border-r text-blue-700 font-semibold hover:bg-blue-700
                            hover:text-white" data-hs-overlay="#hs-stacked-overlays-<?= $profile->id?>"
                            >
                                Xem Hồ Sơ
                            </button>
                            <button type="button" class="w-1/2 text-blue-700 font-semibold hover:bg-blue-700 hover:text-white"
                                    data-hs-overlay="#hs-send-request-<?= $profile->id?>"
                            >
                                Gửi yêu cầu
                            </button>
                        </div>
                    </div>
                @endforeach
                    <!-- Hiển thị phân trang -->
                    {{ $staffs->withQueryString()->links('layouts.pagination', ['role' => 'user']) }}
            @else
                <div class="text-center min-h-[350px] pt-10">
                         Hãy chọn danh mục để tìm thợ
                </div>
            @endif
            </div>
        </div>

    {{-- Chọn danh mục cần tìm--}}
    <div id="hs-overlay-category-searching" class="m-auto rounded-t-2xl hs-overlay hs-overlay-open:translate-y-0 translate-y-full
     fixed bottom-0 inset-x-0 transition-all duration-300 transform max-h-[600px] max-w-[540px] size-full z-[80] bg-white
     border-b dark:bg-neutral-800 dark:border-neutral-700 hidden" tabindex="-1">
        <div class="flex pb-2 mt-2">
            <div class="ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                </svg>
            </div>
            <input class="pe-4 w-full border-none focus:ring-0" placeholder="Sửa điều hòa">
            <button type="button" class="mr-4 px-3 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-overlay-category-searching">
                <span class="sr-only">Close modal</span>
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>
        <div class="px-4 py-2.5 border-t">
            <span class="font-bold text-sm">Danh mục tìm kiếm nhiều nhất</span>
        </div>
        @if (!empty($categories))
            @foreach ($categories as $id => $name)
                <button
                    onclick="search('{{ $id }}')"
                    class="px-4 py-3 border-t font-semibold w-full text-left hover:bg-gray-200"
                    data-hs-overlay="#hs-overlay-category-searching"
                >
                    {{ $name }}
                </button>
            @endforeach
        @endif
    </div>

{{-- Chọn khu vực--}}
    <div id="hs-overlay-area" class="m-auto rounded-t-2xl hs-overlay hs-overlay-open:translate-y-0 translate-y-full fixed bottom-0 inset-x-0 transition-all duration-300 transform max-h-[300px] max-w-[540px] size-full z-[80] bg-white border-b dark:bg-neutral-800 dark:border-neutral-700 hidden" tabindex="-1">
        <div class="flex mt-2 justify-between">
            <div class="px-4 py-2">
                <span class="font-bold text-lg">Tìm theo tỉnh, thành phố</span>
            </div>
            <button type="button" class="mr-4 px-3 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-overlay-area">
                <span class="sr-only">Close modal</span>
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>
        <form>
            <div class="my-2 px-4">
                <select id="province_staffs-searching" class="address_info rounded-md w-full p-3" >
                    <option class="">Chọn tỉnh/ thành phố</option>
                </select>
            </div>

            <div class="my-2 px-4">
                <select id="district_staffs-searching" class="address_info rounded-md w-full p-3" >
                    <option>Chọn quận/ huyện</option>
                </select>
            </div>

            <div class="my-2 px-4">
                <select id="ward_staffs-searching" class="address_info rounded-md w-full p-3" >
                    <option>Chọn phường/ xã</option>
                </select>
            </div>
            <div class=" my-2 px-4">
                <button onclick="searchArea()" type="button" class="rounded-md w-full py-3 bg-blue-700 rounded-lg text-white font-semibold flex justify-center" data-hs-overlay="#hs-overlay-area">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z">
                        </path>
                    </svg>
                    Tìm kiếm
                </button>
            </div>
        </form>
    </div>

{{--    Xem hồ sơ--}}
    @foreach ($staffs as $profile)
        <div id="hs-stacked-overlays-<?=$profile->id?>" class="fixed overflow-y-auto m-auto rounded-t-2xl hs-overlay hs-overlay-open:translate-y-0 translate-y-full bottom-0 inset-x-0 transition-all duration-300 transform max-h-[800px] max-w-[540px] size-full z-[30] bg-white dark:bg-neutral-800 dark:border-neutral-700 hidden" tabindex="-1" data-staff-id="{{$profile->id}}">
            <div class="overflow-y-auto flex justify-end">
                <button type="button" class="right-0 mr-2 px-3 py-3 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-stacked-overlays-<?=$profile->id?>">
                    <span class="sr-only">Close modal</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4 border-b">
                <div class="w-[100px] h-[100px] rounded-full overflow-hidden border-2 m-auto">
                    <img class="w-full h-full" src="{{ Storage::url($profile->image->path) }}">
                </div>
                <div class="flex m-auto justify-center content-center">
                    <p class="font-semibold text-xl mr-1 pt-1">{{$profile->name}}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mt-1 cursor-pointer hover:text-orange-400 hover:bg-gray-300 rounded-md p-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9"></path>
                    </svg>
                </div>
                <div class="text-sm my-2">
                    <p class="description-myself">{{$profile->description}}
                    <p>
                    <div class="mt-2">
                        <span class="font-bold">Khu vực hoạt động</span>
                    </div>
                    @foreach($profile->workAreas as $area)
                        <div class="pt-2 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
                            </svg>
                            <span class="ml-1">{{$area->district->name}}, {{$area->province->name}}</span>
                        </div>
                    @endforeach
                    <div class="mt-4">
                        <span class="font-bold ">Danh mục công việc</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        @foreach($profile-> categories as $work )
                            <div class="border text-center rounded-md mt-1">
                                <p class="line-clamp-1">
                                    {{$work ->name}}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="px-4 py-2 border-b">
                <h3 class="font-bold">Đánh giá</h3>
                <div class="flex ">
                    <div class="flex my-2 align-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                    </div>
                    <p class="mx-2 pt-1 text-orange-500 font-bold">5.0</p>
                    <p class="pt-1">(1 đánh giá)</p>
                </div>
            </div>
            <div class="">
                <div class="m-4 flex">
                    <div class="w-[40px] h-[40px] bg-gray-600 font-semibold text-center text-blue-50 rounded-3xl pt-2">
                        T
                    </div>
                    <div>
                        <div class="ml-2 border-none flex">
                            <span class="font-semibold text-sm">Tên User</span>
                        </div>
                        <div class="ml-2 flex-col ">
                            <small class="text-xs text-gray-400">25/05/2024</small>
                        </div>
                    </div>
                </div>
                <div class="ml-4 flex">
                    <div class="flex my-1 align-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] h-[16px] text-orange-500" >
                            <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                    </div>
                    <p class="mx-2">(5.0)</p>
                </div>
                <span class="ml-4">Thợ sửa cẩn thận </span>
                <div class="w-[50px] h-[50px] rounded overflow-hidden mx-4">
                    <img src="https://haycafe.vn/wp-content/uploads/2022/08/Hinh-anh-meo-khoc.jpg">
                </div>
            </div>
            <button type="button" class="w-full bg-blue-700 fixed bottom-0 py-3 text-white font-semibold hover:bg-blue-800 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-send-request-<?= $profile->id?>" data-hs-overlay-options='{"isClosePrev": false}'>
                Gửi yêu cầu
            </button>
        </div>
    @endforeach
{{-- Xác nhận gửi yêu cầu--}}
    @foreach ($staffs as $profile)
    <div id="hs-send-request-<?= $profile->id?>" class="hs-overlay hidden size-full fixed top-0 start-0 z-[40] overflow-y-auto pointer-events-none">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-end items-center p-2 dark:border-neutral-700">
                    <button type="button" class="flex justify-center items-center size-10 text-sm font-semibold
                    rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50
                    disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700"
                            data-hs-overlay="#hs-send-request-<?= $profile->id?>" name="staff-id">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-2">
                    <p class="text-gray-800 dark:text-neutral-400 text-center font-semibold"
                    >
                        Bạn có chắc chắn muốn gửi yêu cầu đến thợ này?
                    </p>
                </div>
                <div class="flex justify-center items-center gap-x-2 p-6 dark:border-neutral-700">
                    <button id="confirm-request" type="button" onclick="sendRequest(this)" class="send-request-btn py-4 px-4 inline-flex items-center gap-x-2
                    text-sm font-semibold rounded-3xl border border-transparent bg-blue-800 text-white hover:bg-blue-700
                    disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-send-request-<?= $profile->id?>"
                      data-id="{{ $profile->id }}"
                    >
                        Gửi yêu cầu
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <x-slot name="script">
    <script type="module">
        $(document).ready(function() {
            // Load danh sách tỉnh
            $.ajax({
                url: '/provinces',
                method: 'GET',
                success: function (provinces) {
                    $.each(provinces, function (index, province) {
                        $('#province_staffs-searching').append('<option  value="' + index + '">' + province + '</option>');
                    });
                }
            });

            // Load danh sách huyện khi chọn tỉnh
            $('#province_staffs-searching').change(function () {
                var provinceId = $(this).val();
                $.ajax({
                    url: `provinces/${provinceId}/districts`,
                    method: 'GET',
                    success: function (districts) {
                        $('#district_staffs-searching').empty();
                        $('#district_staffs-searching').append('<option class="font-semibold" value="">Chọn quận/ huyện</option>');

                        $.each(districts, function (index, district) {
                            $('#district_staffs-searching').append('<option value="' + index + '">' + district + '</option>');
                        });
                    }
                });
            });

            // Load danh sách xã/phường khi chọn huyện
            $('#district_staffs-searching').change(function () {
                var districtId = $(this).val();
                $.ajax({
                    url: `districts/${districtId}/wards`,
                    method: 'GET',
                    success: function (wards) {
                        $('#ward_staffs-searching').empty();
                        $('#ward_staffs-searching').append('<option class="font-semibold">Chọn phường/ xã</option>');

                        $.each(wards, function (index, ward) {
                            $('#ward_staffs-searching').append('<option value="' + index + '">' + ward + '</option>');
                        });
                    }
                });
            });

        });

        // Load danh sách danh mục
        function search(id, page=1) {
            const data = {
                category_id: id,
            }
            if (parseInt($('#province_staffs-searching').val()) > 0) {
                data.province_id = parseInt($('#province_staffs-searching').val());
            }
            if (parseInt($('#district_staffs-searching').val()) > 0) {
                data.district_id = parseInt($('#district_staffs-searching').val());
            }
            // Lấy id danh mục để tìm kiếm thợ
            const baseUrl = '/staffs-searching';
            const params = Object.entries(data)
                .map(([key, value]) => `${key}=${encodeURIComponent(value)}`)
                .join('&');
            const urlWithParams = `${baseUrl}?${params}`;
            window.location.href = urlWithParams;
        }
        // Hiển giá trị tỉnh/ huyện / xã in ra button
        function searchArea() {
            var provinceSelect = document.getElementById('province_staffs-searching');
            var districtSelect = document.getElementById('district_staffs-searching');
            var wardSelect = document.getElementById('ward_staffs-searching');

            var province = provinceSelect.options[provinceSelect.selectedIndex].text;
            var district = districtSelect.options[districtSelect.selectedIndex].text;
            var ward = wardSelect.options[wardSelect.selectedIndex].text;

            var area = ward + ', ' + district + ', ' + province;
            document.getElementById('display-area').innerText = area;
        }
        // Gửi yêu cầu
            function sendRequest(element) {
                var messageDiv = document.getElementById('message');
                const categoryId = $('button[data-hs-overlay="#hs-overlay-category-searching"]').data('category-id');
                const staffId = $(element).data('id');
                $.ajax ({
                    url: `{{route('request.send')}}`,
                    type: 'POST',
                    data: {
                        category_id: categoryId,
                        staff_id: staffId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        messageDiv.textContent = 'Bạn đã gửi yêu cầu thành công!';
                        messageDiv.className = 'alert alert-success';
                        messageDiv.style.display = 'block';
                        setTimeout(() => {
                            messageDiv.style.display = 'none';
                        }, 3000);
                    },
                    error: function (xhr) {
                        if(xhr.status === 401){
                            window.location.href = xhr.responseJSON.redirect;
                        }else {
                            console.error('Error:', xhr.responseText);
                            messageDiv.textContent = 'Gửi yêu cầu thất bại, xin kiểm tra lại!';
                            messageDiv.className = 'alert alert-danger';
                            messageDiv.style.display = 'block';
                            setTimeout(() => {
                                messageDiv.style.display = 'none';
                            }, 3000);
                        }
                    }
                });
            }
        window.sendRequest = sendRequest;
        window.search = search;
        window.searchArea = searchArea;
    </script>
    </x-slot>
</x-user-layout>
