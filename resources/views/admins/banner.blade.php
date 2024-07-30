<x-admin-layout>
    <x-slot name="header">
        Quản lý banner
    </x-slot>
    <div class="space-y-8">
        <div class="font-bold text-2xl">Quản lý banner</div>
        <div class="flex justify-end items-center">
            <button class="whitespace-nowrap py-2 px-4 inline-flex items-center justify-center text-sm font-semibold rounded-lg border border-transparent text-green-500 bg-green-100 hover:bg-green-200" data-hs-overlay="#modal-add">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Thêm banner
            </button>
        </div>

        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-8">
            @foreach($banners as $banner)
                <div class="relative">
                    <img class="rounded-lg border border-gray-400" src="{{ Storage::url($banner->image->path) }}" alt="">
                    <button class="absolute border border-white rotate-45 border-b-gray-500 -top-4 -right-4 bg-white rounded-full" onclick='event.preventDefault(); if (confirm("Bạn có chắc chắn xóa banner này?")) this.nextElementSibling.submit()'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </button>
                    <form action="{{ route('admin.banners.destroy', $banner) }}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            @endforeach
        </div>

        <div id="modal-add" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden pointer-events-none">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-2xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <form action="{{ route('admin.banners.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                            <h3 class="font-bold text-gray-800 dark:text-white">
                                Thêm banner
                            </h3>
                            <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#modal-add">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4 sm:flex-row flex flex-col text-sm gap-2">
                            <div class="w-full h-auto">
                                <div id="preview" class="justify-center flex items-center border-2 border-dashed border-gray-300 rounded-lg min-h-64 overflow-hidden mt-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 opacity-20">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex sm:flex-col flex-row items-center justify-center gap-2 mb-4 whitespace-nowrap">
                                <input type="file" name="image" id="file-input" class="hidden w-full border border-gray-300 rounded-md mt-3 py-2 px-3 focus:outline-none focus:border-blue-500">
                                <label for="file-input" class="py-2 px-3 w-24 flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 cursor-pointer">
                                    Chọn ảnh
                                </label>
                                <span id="crop-btn" class="py-2 px-3 w-24 flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 cursor-pointer">
                                    Cắt ảnh
                                </span>
                            </div>
                        </div>
                        <div class="flex justify-center items-center gap-x-2 py-3 px-4">
                            <button id="submit" type="submit" disabled class="hidden py-3 px-4 w-32 flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Lưu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/admin/banner.js')
</x-admin-layout>
