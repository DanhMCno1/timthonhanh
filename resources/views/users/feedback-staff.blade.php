<x-user-layout>
    <x-slot name="header">
        Lịch sử gửi yêu cầu thợ
    </x-slot>
    
    <div class="bg-white shadow rounded-t-md min-h-[80vh] mt-3 border">
        <form id="submit" enctype="multipart/form-data" class="pt-3 px-4">
            @csrf
            <h3 class="text-3xl font-bold text-center pt-2">Đánh giá chất lượng</h3>
            <div class="flex pt-10">
                <div>
                    <img class="w-[60px] aspect-square rounded-full" src="{{ Storage::url($staff->image->path) }}">
                </div>
                <div class="ps-4">
                    <div class="text-xl font-bold">{{ $staff->name }}</div>
                    <div class="flex mt-2">
                        <div class="flex flex-row justify-end items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <input id="hs-ratings-readonly-1" type="radio" class="peer -ms-4 size-4 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0" name="hs-ratings-readonly" value="5" disabled>
                                <label for="hs-ratings-readonly-1" class="peer-checked:text-orange-400 @if ($i <= $staff->average_rating) text-orange-400 @else text-gray-300 @endif pointer-events-none">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                    </svg>
                                </label>
                            @endfor
                        </div>
                        <div>
                            <span class="ms-2 text-sm"> 
                                {{ $staff->average_rating }}
                                <span class="ps-1">({{ count($feedbacks) }} đánh giá)</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-10 space-y-3">
                <div> Chọn danh mục đánh giá <span class="text-red-600">*</span></div>
                <ul class="grid grid-cols-3 gap-2">
                    @foreach ($staff->categories as $category)
                    <li>
                        <input type="radio" id="{{ $category->name }}" name="category" value="{{ $category->id }}" class="hidden category peer">
                        <label for="{{ $category->name }}" class="flex items-center justify-center w-full py-2 border border-[#1f2937] hover:bg-[#1f2937] hover:text-white rounded-lg font-normal cursor-pointer peer-checked:bg-[#1f2937] peer-checked:text-white">                           
                            <div class="block">
                                <div class="w-full text-xs">{{ $category->name }}</div>
                            </div>
                        </label>
                    </li>
                    @endforeach
                </ul>
                <div class="flex justify-center">
                    <div class="flex flex-row-reverse justify-end items-center">
                        <input id="hs-ratings-readonly-1" type="radio" class="peer -ms-6 size-6 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0" name="rating" value="5" checked>
                        <label for="hs-ratings-readonly-1" class="peer-checked:text-orange-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-2" type="radio" class="peer -ms-6 size-6 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0" name="rating" value="4">
                        <label for="hs-ratings-readonly-2" class="peer-checked:text-orange-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-3" type="radio" class="peer -ms-6 size-6 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0" name="rating" value="3">
                        <label for="hs-ratings-readonly-3" class="peer-checked:text-orange-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-4" type="radio" class="peer -ms-6 size-6 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0" name="rating" value="2">
                        <label for="hs-ratings-readonly-4" class="peer-checked:text-orange-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-5" type="radio" class="peer -ms-6 size-6 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0" name="rating" value="1">
                        <label for="hs-ratings-readonly-5" class="peer-checked:text-orange-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                            </svg>
                        </label>
                    </div>
                </div>
            </div>
            <div class="pt-3 space-y-3">
                <div>Nội dung</div>
                <div>
                    <textarea name="comment" class="comment textarea textarea-bordered rounded-lg border-[#1f293733] focus:border-primary-user focus:ring-0 focus:outline-primary-user w-full min-h-[120px]"></textarea>
                </div>
            </div>
            <div class="pt-6 space-y-3">
                <label for="fileInput">
                    <div class="py-1 px-2 inline-flex items-center gap-x-2 text-sm rounded-lg border border-blue-700 text-blue-700 hover:bg-blue-700 hover:text-white cursor-pointer disabled:opacity-50 disabled:pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
                        </svg>
                        <span>Thêm ảnh</span>
                    </div>
                </label>
                <input class="hidden" id="fileInput" type="file" multiple="" name="images[]" accept="image/*">
                <div class="grid grid-cols-5 gap-1 pt-4 preview">
                </div>
            </div>
            <div class="py-6">
                <button type="button" class="w-full px-auto py-3 px-4 flex justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-700 text-white hover:bg-blue-800 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-vertically-centered-modal">
                    Đánh giá
                </button>

                <div id="hs-vertically-centered-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
                    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                        <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                            <div class="flex justify-end items-center py-3 px-4">
                                <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-vertically-centered-modal">
                                    <span class="sr-only">Close</span>
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4 overflow-y-auto flex items-center justify-center">
                                <p class="text-center text-base">Bạn có chắc chắn muốn đánh giá ?</p>
                            </div>
                            <div class="flex justify-center items-center gap-x-2 py-3 px-4">
                                <button class="py-3 px-5 inline-flex items-center gap-x-2 text-base font-semibold rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"  data-hs-overlay="#hs-vertically-centered-modal">
                                    Đánh giá
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <x-slot name="script">
        <script type="module">
            window.appConfig = {
                urls: {
                    postFeedback: '{{ route('feedback-staff.store', ['staff' => $staff->id]) }}',
                    requestedStaff: '{{ route('requested-staffs.index') }}',
                },
                csrfToken: '{{ csrf_token() }}'
            };
        </script>
        @vite('resources/js/user/feedback.js')
    </x-slot>
</x-user-layout>
