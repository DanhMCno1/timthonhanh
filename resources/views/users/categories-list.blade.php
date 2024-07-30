<x-user-layout>
    <x-slot name="header">
        Danh sách danh mục
    </x-slot>
    <div class="main">
        {{-- Find worker  --}}
        <div class="my-3 border rounded-t-md bg-white shadow rounded min-h-[70vh] ">
            <section class="shadow rounded-lg ">
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
                            <div class="px-6 flex justify-between items-center dropdown-toggle"
                                 data-target="#dropdown{{ $genre->id }}">
                                <div class="flex space-x-2 items-center !min-h-[auto] text-gray-600 py-4">
                                    <img src="{{ Storage::url($genre->image->path) }}" class="w-5">
                                    <span>{{ $genre->name }}</span>
                                </div>
                                <svg class="icon transition size-4 text-gray-600 dark:text-neutral-600"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"></path>
                                </svg>
                            </div>
                            <div id="dropdown{{ $genre->id }}" class="hidden rounded-none p-0 py-0 !pb-0">
                                @foreach($genre->categories as $category)
                                    <a href="/staffs-searching?category_id={{ $category->id }}"
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
    </div>

    <x-slot name="script">
        <script type="module">
            //Find staffs
            $('.dropdown-toggle').on('click', function () {
                const targetId = $(this).data('target');
                const icon = $(this).find('.icon');
                const targetMenu = $(targetId);

                if (targetMenu.hasClass('show')) {
                    targetMenu.removeClass('show').addClass('hidden');
                    icon.removeClass('rotate-180');
                } else {
                    $('.dropdown-menu').removeClass('show').addClass('hidden');
                    targetMenu.removeClass('hidden').addClass('show');
                    icon.addClass('rotate-180');
                }
            });
        </script>
    </x-slot>
</x-user-layout>
