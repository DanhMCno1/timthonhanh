<x-user-layout>
    <x-slot name="header">
        Blog hướng dẫn , chia sẻ.
    </x-slot>
    <div class="p-2 rounded-t-md min-h-[75vh] mt-3 bg-white shadow rounded ">
        <h3 class="text-3xl font-semibold text-center mb-4">Blog</h3>
        @foreach($blogs as $blog)
                <div class="bg-white rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <a class="pb-4 group bg-white shadow-sm rounded-xl overflow-hidden hover:shadow-lg transition dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70" href="{{ route('blogs.pick', ['slug' => $blog->slug]) }}">
                        <div class="relative pt-[60%] overflow-hidden">
                            <img class="w-full h-[300px] absolute top-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out" src="{{ Storage::url($blog->image->path) }}" alt="Image Description">
                        </div>
                        <div class="mx-2 pb-8 border-b mb-10">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white line-clamp-3">
                                {{$blog->title}}
                            </h3>
                            <p class="text-gray-500 dark:text-neutral-400 line-clamp-3">
                                {{$blog->summary}}
                            </p>
                            <p class="mt-5 text-xs text-gray-500 dark:text-neutral-500">
                                Cập nhật {{ $blog->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                </div>
        @endforeach
            {{ $blogs->links('layouts.pagination', ['role' => 'user']) }}
    </div>
</x-user-layout>

