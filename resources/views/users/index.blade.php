<x-user-layout>
    <x-slot name="header">
        Tìm Thợ Nhanh - Uy Tín An Tâm!
    </x-slot>

    <div class="main">
        {{-- Search  --}}
        <div class="my-3 border rounded-t-md bg-white shadow rounded">
            <section class="bg-white py-4 px-4 shadow space-y-2 rounded-md">
                <div class="w-full">
                    <div class="relative">
                        <input id="search-input" type="text" placeholder="Bạn muốn tìm thợ nào"
                               class="p-3 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primaryUserColor focus:ring-0 focus:outline-primaryUserColor">
                        <button class="absolute inset-y-0 end-0 flex items-center z-2 pe-3.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="m-0 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                            </svg>
                        </button>
                        <div
                            class="drop-down absolute top-full opacity-0 z-[3] transition bg-white shadow-lg rounded-b-lg w-full">
                            <h4 class="px-4 py-3 font-medium border-b">Danh mục tìm kiếm nhiều nhất</h4>
                            <ul class="category-list rounded-b-lg w-full">
                                @foreach($categories as $category)
                                    <li class="most-searched hidden cursor-pointer">
                                        <a href="{{ route('staffs-searching' , ['category_id' => $category->id]) }}"
                                           class="font-medium rounded-none  w-full h-full block hover:bg-gray-100 px-4 py-3">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            {{-- Danh mục tìm kiếm không tồn tại--}}
                            <div class="empty-search hidden rounded-b-lg w-full p-4">
                                <span class="mx-auto my-auto">Danh mục tìm kiếm không tồn tại</span>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        {{-- Carousel  --}}
        <div class="my-3 border rounded-t-md bg-white shadow rounded">
            <section class="p-2 shadow border rounded-lg">
                <div data-hs-carousel='{"loadingClasses": "opacity-0", "isAutoPlay": true, "speed": 4000}' class="relative">
                    <div class="hs-carousel relative overflow-hidden w-full min-h-72 bg-white rounded-lg">
                        <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
                            @foreach($banners as $banner)
                                <div class="hs-carousel-slide">
                                    <div class="flex items-center justify-center h-full bg-gray-100">
                                        <img src="{{ Storage::url($banner->image->path) }}" alt="">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="hs-carousel-prev hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 rounded-s-lg">
                    </button>
                    <button type="button" class="hs-carousel-next hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 rounded-e-lg">
                    </button>

                    <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2">
                        @foreach($banners as $banner)
                            <span class="hs-carousel-active:bg-blue-700 hs-carousel-active:opacity-90 opacity-40 hs-carousel-active:border-blue-700 size-2 bg-gray-400 rounded-full cursor-pointer"></span>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        {{-- Categories --}}
        <div class="my-3 border rounded-t-md bg-white shadow rounded">
            <section class="py-4 px-2 shadow space-y-2 rounded-md">
                <h2 class="font-bold mb-4 flex">
                    <div class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z">
                            </path>
                        </svg>
                        <span>Danh mục được tìm kiếm nhiều nhất</span>
                    </div>
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 rounded-md p-2">
                    {{-- Item  --}}
                    @foreach($categories->take(6) as $category)
                        <a href="{{ route('staffs-searching' , ['category_id' => $category->id]) }}"
                           class="relative rounded-lg aspect-video bg-gray-100 bg-cover bg-center"
                           style="background-image:url('{{ Storage::url($category->image->path) }}');"
                        >
                        <span
                            class="absolute w-[100px] flex justify-center px-[.563rem] h-5 items-center rounded-3xl text-xs bg-[#2b3440] text-[#d7dde4] right-2 top-2">
                            <div class=" line-clamp-1" >{{ $category->name }}</div>
                        </span>
                        </a>
                    @endforeach
                </div>
                <p class="text-xs px-2">Để đăng ký làm thợ, vui lòng <a href="/staff/auth/signup"
                                                                        class="text-red-500 underline">click vào đây</a>
                </p>
            </section>
        </div>

        {{-- Find worker  --}}
        <div class="my-3 border rounded-t-md bg-white shadow rounded">
            <section class="shadow rounded-lg">
                <h2 class="font-bold flex items-center space-x-2 p-4 border-b-[1px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                        </path>
                    </svg>
                    <span>Tìm kiếm thợ theo danh mục</span>
                </h2>
                <div>
                    @foreach($genres as $genre)
                        <div class="rounded-none transition-none cursor-pointer">
                            <div class="px-6 flex justify-between items-center hs-collapse-toggle" id="hs-basic-collapse{{ $genre->id }}" data-hs-collapse="#hs-basic-collapse-heading{{ $genre->id }}">
                                <div class="flex space-x-2 items-center !min-h-[auto] text-gray-600 py-4">
                                    <img src="{{ Storage::url($genre->image->path) }}" class="w-5">
                                    <span>{{ $genre->name }}</span>
                                </div>
                                <svg class="hs-collapse-open:rotate-180 size-4 text-gray-600"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"></path>
                                </svg>
                            </div>
                            <div id="hs-basic-collapse-heading{{ $genre->id }}" class="hs-collapse hidden rounded-none p-0 py-0 !pb-0 overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-collapse{{ $genre->id }}">
                                @foreach($genre->categories as $category)
                                    <a href="{{ route('staffs-searching' , ['category_id' => $category->id]) }}"
                                       class="px-6 py-3 bg-gray-50 border-b-[1px] flex justify-between items-center">
                                        <span class="text-sm">{{ $category->name }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        {{-- Comments --}}
        <div class="my-3 border rounded-t-md bg-white shadow rounded">
            <section class="bg-base-100 py-4 shadow space-y-2 rounded-t-md">
                <h2 class="font-bold mb-4 flex items-center space-x-2 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                    </svg>
                    <span>Feedback từ khách hàng</span></h2>
                <div class="">
                    @foreach ($feedbacks->take(10) as $feedback)
                        <div class="border-t-[1px] py-3 px-3">
                            <div class="space-x-2 flex container">
                                <div
                                    class="min-w-[35px] w-[35px] aspect-square rounded-full bg-gray-600 flex justify-center items-center">
                                    <span class="uppercase text-white text-lg">
                                        {{ substr( $feedback->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div class="w-full h-full ml-2">
                                    <div class=""><h4 class="font-medium text-sm">{{ $feedback->user->name }}</h4>
                                        <div class="text-xs text-gray-400"><span>{{ $feedback->created_at->format('d/m/Y') }}</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex mt-2">
                                <div class="flex flex-row justify-end items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input id="hs-ratings-readonly-1" type="radio" class="peer -ms-4 size-4 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0" name="hs-ratings-readonly" value="5" disabled>
                                        <label for="hs-ratings-readonly-1" class="peer-checked:text-orange-400 @if ($i <= $feedback->rating) text-orange-400 @else text-gray-300 @endif pointer-events-none">
                                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                                <div>
                                    <span class="ms-2 text-sm"> 
                                        <span class="ps-1">({{ $feedback->rating }})</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="text-sm line-clamp-3"><span class="break-words">{{ $feedback->comment }}</span>
                                </div>
                                <div class="flex rounded-md space-x-2">
                                    @foreach ($feedback->images as $image)
                                        <div class="cursor-pointer" data-hs-overlay="#hs-vertically-centered-modal{{ $image->id }}">
                                            <img src="{{ Storage::url($image->path) }}" class="bg-blue-50 rounded-lg h-[50px] aspect-square">
                                        </div>

                                        <div id="hs-vertically-centered-modal{{ $image->id }}" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
                                            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center justify-center">
                                                <div class="flex flex-col shadow-sm rounded-xl pointer-events-auto">
                                                    <div class="relative">
                                                        <img src="{{ Storage::url($image->path) }}" alt="Ảnh">
                                                        <button type="button" class="absolute -top-4 -right-4 flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent bg-white text-gray-800 hover:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-vertically-centered-modal{{ $image->id }}">
                                                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 6 6 18"></path>
                                                            <path d="m6 6 12 12"></path>
                                                            </svg>
                                                        </button>                                             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <x-slot name="script">
        <script type="module">
            const dropdownSearch = $('.drop-down');
            const searchInput = $('#search-input');
            searchInput.blur(function () {
                dropdownSearch.removeClass('opacity-100');
            });

            const mostSearched = $('.most-searched');
            searchInput.on('focus', function () {
                mostSearched.removeClass('hidden');
                dropdownSearch.addClass('opacity-100');
            })

            searchInput.on('input ', function () {
                let typingTimer;
                const doneTypingInterval = 130;
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function () {
                        dropdownSearch.addClass('opacity-100');
                        let categoryList = $('.category-list');
                        $.ajax({
                            url: '{{ route('search') }}',
                            data: {
                                search: searchInput.val().trim(),
                            },
                            success: function (data) {
                                categoryList.empty();

                                if (searchInput.val().trim() !== '') {
                                    $('.drop-down h4').addClass('hidden');
                                    if (data.length === 0) {
                                        $('.empty-search').removeClass('hidden');
                                    } else {
                                        $('.empty-search').addClass('hidden');
                                    }
                                } else {
                                    $('.drop-down h4').removeClass('hidden');
                                    $('.empty-search').addClass('hidden');
                                }

                                data.forEach(function (category) {
                                    categoryList.append(`
                                    <li class="py-3 pl-4">
                                        <a href="#" class="font-medium rounded-none">
                                            ${category.name}
                                        </a>
                                    </li>
                                   `);
                                });
                            },
                        });
                    },
                    doneTypingInterval
                );
            });
        </script>
    </x-slot>
</x-user-layout>
