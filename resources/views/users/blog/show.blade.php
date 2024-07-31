<x-user-layout>
    <x-slot name="header">
        {{$blogs -> title}}
    </x-slot>
    <div class="p-2 rounded-t-md min-h-[75vh] mt-3 bg-white shadow rounded ">
            <div class="bg-white rounded-xl shadow-sm dark:bg-neutral-900 dark:shadow-neutral-700/70">
                    <div class="relative pt-[60%] overflow-hidden">
                        <img class="w-full h-[300px] absolute top-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out" src="{{ Storage::url($blogs->image->path) }}" alt="Image Description">
                    </div>
                    <div class="mx-2 mb-10">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white uppercase">
                            {{$blogs->title}}
                        </h3>
                        <div class="ml-2 mb-2 flex items-center text-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-2">
                                <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/>
                            </svg>
                             {{ $blogs->created_at->format(' H:i d/m/Y ') }}
                        </div>
                        <p class="text-gray-500 dark:text-neutral-400">
                            {{$blogs->summary}}
                        </p>
                        <div class="text-gray-500 dark:text-neutral-400" >{!! $blogs->content !!}</div>
                    </div>
                </a>
            </div>
    </div>
</x-user-layout>


