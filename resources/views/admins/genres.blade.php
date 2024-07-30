<x-admin-layout>
    <x-slot name="header">
        Quản lý đơn mua
    </x-slot>
    <div>
        <div class="font-bold text-2xl">Quản lý danh mục</div>

        <div class="flex flex-col mt-5">
            <nav class="pb-1 flex space-x-3 overflow-x-auto [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300">
                @foreach($genres as $genre)
                    <button type="button" class="py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-none text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600" id="genre-{{ $genre->id }}" role="tab" data-href="{{ route('admin.genres.index', ['genre_id' => $genre->id]) }}">
                        #{{ $genre->id }} - {{ $genre->name }}
                    </button>
                @endforeach
            </nav>
        </div>
        <div id="list-genre" class="mt-3"></div>

    </div>
    <x-slot name="script">
        <script type="module">
            window.appConfig = {
                urls: {
                    store: '{{ route('admin.categories.store') }}',
                    edit: '{{ route('admin.categories.edit', ['category' => ':category']) }}',
                    update: '{{ route('admin.categories.update', ['category' => ':category']) }}'
                },
                csrfToken: '{{ csrf_token() }}'
            };
        </script>
    </x-slot>
    @vite('resources/js/admin/genre.js')
</x-admin-layout>
