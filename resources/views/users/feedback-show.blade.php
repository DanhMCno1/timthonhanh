<x-user-layout>
    <x-slot name="header">
        Lịch sử gửi yêu cầu thợ
    </x-slot>
    
    <div class="bg-white shadow rounded-t-md min-h-[80vh] mt-3 border">
        <div class="pt-3 px-4">
            <h3 class="text-3xl font-bold text-center pt-2">Đánh giá của bạn</h3>
            <div class="flex pt-10">
                <div>
                    <img class="w-[60px] aspect-square rounded-full" src="{{ Storage::url($staff->image->path) }}">
                </div>
                <div class="ps-4 flex items-center">
                    <div class="text-xl font-bold">{{ $staff->name }}</div>
                </div>
            </div>
            <div class="space-y-5">
                <div class="pt-5 space-y-3">
                    <div class="font-bold"> Danh mục đánh giá: </div>
                    <div>
                        <span class="p-2 text-sm border">{{ $feedback->category->name }}</span>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="font-bold">Đánh giá:</div>
                    <div class="flex mt-2">
                        <div class="flex flex-row justify-end items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $feedback->rating)
                                    <input id="hs-ratings-readonly" type="radio" class="peer -ms-4 size-4 bg-transparent border-0 text-transparent appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0" name="hs-ratings-readonly" value="" disabled>
                                    <label for="hs-ratings-readonly" class="peer-checked:text-orange-400 text-orange-400 pointer-events-none">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                        </svg>
                                    </label>
                                @else
                                    <input id="hs-ratings-readonly" type="radio" class="peer -ms-4 size-4 bg-transparent border-0 text-transparent appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0" name="hs-ratings-readonly" value="" disabled>
                                    <label for="hs-ratings-readonly" class="peer-checked:text-orange-400 text-gray-300 pointer-events-none">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                        </svg>
                                    </label>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="space-y-5">
                    <div class="space-y-2">
                        <div class="font-bold">Ngày đánh giá:</div>
                        <div>{{ $feedback->created_at->format('d/m/y') }} {{ $feedback->created_at->format('h:m') }}</div>
                    </div>
                    <div class="space-y-2">
                        <div class="font-bold">Nội dung:</div>
                        <div>{{ $feedback->comment }}</div>
                    </div>
                    <div class="space-y-3">
                        <div class="font-bold">Hình ảnh:</div>
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
            </div>
        </div>
    </div>

</x-user-layout>
