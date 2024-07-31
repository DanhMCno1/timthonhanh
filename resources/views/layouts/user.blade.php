<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $header }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/user.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-[#F7F9FC]">
<div class="max-w-[540px] min-h-[100vh] m-auto shadow-md bg-[#F7F9FC]">
    <div class="flex min-h-16 items-center navbar bg-white shadow rounded z-[10] sticky top-0 p-[8px]">
        <div class="flex-1 inline-flex">
            <a href="{{ route('user.home') }}" class="text-xl flex items-end px-2">
                <span class="text-primary-user text-3xl font-bold leading-8">Tìmthợ</span>
                <span class="font-medium">nhanh.vn</span>
            </a>
        </div>
        <div>
            <button type="button"
                    class="text-2xl flex justify-center items-center border-4 border-white hover:border-gray-300 overflow-hidden w-12 h-12 duration-300 hover:bg-gray-300 font-medium rounded-full"
                    data-hs-overlay="#hs-overlay-right">
                @if(Auth::check())
                    <div
                        class="w-[40px] h-[40px] bg-gray-600 font-semibold text-center text-lg text-blue-50 rounded-3xl flex justify-center items-center capitalize">
                        {{ substr(Auth::guard('web')->user()->name, 0, 1) }}
                    </div>
                @else
                    <svg class="swap-off fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                         viewBox="0 0 512 512">
                        <path d="M64,384H448V341.33H64Zm0-106.67H448V234.67H64ZM64,128v42.67H448V128Z"></path>
                    </svg>
                @endif
            </button>
        </div>
    </div>

    @if(Auth::check())
        <ul id="hs-overlay-right"
            class="text-sm right-0 z-40 p-2 overflow-y-auto transition-all bg-gray-50 w-64 hs-overlay hs-overlay-open:translate-x-0 hidden translate-x-full fixed top-0 end-0 duration-300 transform h-full max-w-xs border-s [--body-scroll:true]"
            tabindex="-1">
            <a href="{{ route('profile.edit') }}">
                <div class="flex-shrink-0 group block p-[8px]">
                    <div class="flex items-center">
                        <div
                            class="border border-gray-300 flex items-center justify-center w-[40px] h-[40px] rounded-full overflow-hidden">
                            <div
                                class="w-[40px] h-[40px] bg-gray-600 font-semibold text-center text-lg text-blue-50 rounded-3xl flex justify-center items-center capitalize">
                                {{ substr(Auth::guard('web')->user()->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="ms-3">
                            <h3 class="font-semibold text-gray-800">{{ Auth::guard('web')->user()->name }}</h3>
                            <p>{{ Auth::guard('web')->user()->phone }}</p>
                        </div>
                    </div>
                </div>
            </a>
            <hr class="border-gray-200 my-2 border">
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{route('categories-list')}}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                        <path
                            d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"></path>
                    </svg>
                    Danh sách danh mục
                </a>
            </li>
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{ route('requested-staffs.index') }}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 640 512">
                        <path
                            d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z">
                        </path>
                    </svg>
                    Danh sách thợ đã liên hệ
                </a>
            </li>
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{route('staffs-searching')}}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                        <path
                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                    </svg>
                    Tìm kiếm thợ
                </a>
            </li>
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{route('contact')}}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"></path>
                    </svg>
                    Liên hệ
                </a>
            </li>
            <hr class="border-gray-200 my-2 border">
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a onclick="event.preventDefault(); this.nextElementSibling.submit();" class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"></path>
                    </svg> Đăng xuất
                </a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                </form>
            </li>
        </ul>
    @else
        <ul id="hs-overlay-right"
            class="text-sm right-0 z-40 p-4 overflow-y-auto transition-all bg-gray-50 w-64 hs-overlay hs-overlay-open:translate-x-0 hidden translate-x-full fixed top-0 end-0 duration-300 transform h-full max-w-xs border-s [--body-scroll:true]"
            tabindex="-1">
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{route('categories-list')}}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                        <path
                            d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"></path>
                    </svg>
                    Danh sách danh mục
                </a>
            </li>
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{route('staffs-searching')}}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                        <path
                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                    </svg>
                    Tìm kiếm thợ
                </a>
            </li>
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{ route('signin') }}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                        <path
                            d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"></path>
                    </svg>
                    Đăng nhập
                </a>
            </li>
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{ route('signup') }}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 640 512">
                        <path
                            d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"></path>
                    </svg>
                    Đăng ký
                </a>
            </li>
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{route('contact')}}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                        <path
                            d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"></path>
                    </svg>
                    Liên hệ
                </a>
            </li>
            <hr class="border-gray-200 my-2 border">
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{ route('staff.signin.create') }}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Thợ đăng nhập
                </a>
            </li>
            <li class="items-stretch flex flex-col flex-shrink-0 flex-wrap relative hover:bg-gray-300 rounded-lg duration-300">
                <a href="{{ route('staff.signup.create') }}"
                   class="px-4 py-2 grid items-center content-start gap-2 auto-cols-max select-none grid-flow-col">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"></path>
                    </svg>
                    Đăng ký thợ
                </a>
            </li>
        </ul>
    @endif

    {{ $slot }}

    <footer class="items-center place-items-center gap-6 p-6 bg-[#2b3440] text-sm text-[#d7dde4] flex flex-col">
        <nav class="place-items-center gap-2 lg:grid text-sm lg:grid-cols-3 lg:text-base">
            <a href="/about" class="cursor-pointer hover:underline">Về timthonhanh.vn</a>
            <a href="{{route('contact')}}" class="cursor-pointer hover:underline">Liên hệ</a>
            <a href="/dieu-khoan-su-dung" class="cursor-pointer hover:underline">Điều khoản sử dụng</a>
        </nav>
        <nav class="place-items-center gap-2 grid">
            <div class="grid grid-flow-col gap-4">
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         class="fill-current">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                    </svg>
                </a>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         class="fill-current">
                        <path
                            d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                    </svg>
                </a>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         class="fill-current">
                        <path
                            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                    </svg>
                </a>
            </div>
        </nav>
        <aside class="place-items-center gap-2 grid">
            <a href="https://tmi-soft.com/" rel="noopener noreferrer" class="cursor-pointer hover:underline">Copyright ©
                2024 - Công ty cổ phần TMI.</a>
            <p>GPDKKD số 0109904638 do sở KH &amp; ĐT Hà Nội cấp ngày 11/02/2022</p>
        </aside>
    </footer>
</div>

<a href="{{route('blogs.index')}}" class="flex flex-col sm:w-[60px] sm:h-[60px] md:w-[80px] md:h-[80px] rounded-full bottom-5 fixed right-5 bg-blue-500 shadow-2xl items-center justify-center focus:scale-95">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 "><path d="M162.4 196c4.8-4.9 6.2-5.1 36.4-5.1 27.2 0 28.1 .1 32.1 2.1 5.8 2.9 8.3 7 8.3 13.6 0 5.9-2.4 10-7.6 13.4-2.8 1.8-4.5 1.9-31.1 2.1-16.4 .1-29.5-.2-31.5-.8-10.3-2.9-14.1-17.7-6.6-25.3zm61.4 94.5c-53.9 0-55.8 .2-60.2 4.1-3.5 3.1-5.7 9.4-5.1 13.9 .7 4.7 4.8 10.1 9.2 12 2.2 1 14.1 1.7 56.3 1.2l47.9-.6 9.2-1.5c9-5.1 10.5-17.4 3.1-24.4-5.3-4.7-5-4.7-60.4-4.7zm223.4 130.1c-3.5 28.4-23 50.4-51.1 57.5-7.2 1.8-9.7 1.9-172.9 1.8-157.8 0-165.9-.1-172-1.8-8.4-2.2-15.6-5.5-22.3-10-5.6-3.8-13.9-11.8-17-16.4-3.8-5.6-8.2-15.3-10-22C.1 423 0 420.3 0 256.3 0 93.2 0 89.7 1.8 82.6 8.1 57.9 27.7 39 53 33.4c7.3-1.6 332.1-1.9 340-.3 21.2 4.3 37.9 17.1 47.6 36.4 7.7 15.3 7-1.5 7.3 180.6 .2 115.8 0 164.5-.7 170.5zm-85.4-185.2c-1.1-5-4.2-9.6-7.7-11.5-1.1-.6-8-1.3-15.5-1.7-12.4-.6-13.8-.8-17.8-3.1-6.2-3.6-7.9-7.6-8-18.3 0-20.4-8.5-39.4-25.3-56.5-12-12.2-25.3-20.5-40.6-25.1-3.6-1.1-11.8-1.5-39.2-1.8-42.9-.5-52.5 .4-67.1 6.2-27 10.7-46.3 33.4-53.4 62.4-1.3 5.4-1.6 14.2-1.9 64.3-.4 62.8 0 72.1 4 84.5 9.7 30.7 37.1 53.4 64.6 58.4 9.2 1.7 122.2 2.1 133.7 .5 20.1-2.7 35.9-10.8 50.7-25.9 10.7-10.9 17.4-22.8 21.8-38.5 3.2-10.9 2.9-88.4 1.7-93.9z"/></svg>
    Blogs
</a>

<script type="module">
    $(document).ready(function () {
        const toastrMessage = localStorage.getItem('toastrMessage');
        const toastrType = localStorage.getItem('toastrType');
        if (toastrMessage && toastrType) {
            toastr[toastrType](toastrMessage);
            localStorage.removeItem('toastrMessage');
            localStorage.removeItem('toastrType');
        }
    })

    @if(session('success'))
    toastr.success("{{ session('success') }}")
    @endif
    @if(session('error'))
    toastr.error(
        "{{ session('error') }}")
    @endif
</script>
@if (isset($script))
    {{ $script }}
@endif
</body>
