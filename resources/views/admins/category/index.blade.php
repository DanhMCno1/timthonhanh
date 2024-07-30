<div class="-m-1.5 overflow-x-auto [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300">
    <div class="flex justify-end items-center">
        <button class="whitespace-nowrap py-2 px-4 inline-flex items-center justify-center text-sm font-semibold rounded-lg border border-transparent text-green-500 bg-green-100 hover:bg-green-200" data-hs-overlay="#modal-add">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Thêm danh mục
        </button>

        <div id="modal-add" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                        <h3 class="font-bold text-gray-800 dark:text-white">
                            Thêm danh mục mới
                        </h3>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <form id="add-category" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="flex flex-col">
                                <div class="flex justify-center">
                                    <label for="image-input-add" class="cursor-pointer">
                                        <input type="file" name="image" id="image-input-add" class="hidden">
                                        <div class="border-gray-300 col rounded-full overflow-hidden w-[120px] h-[120px] flex justify-center items-center">
                                            <i data-name="icon" class="text-6xl fa-solid fa-cloud-arrow-up"></i>
                                            <img class="w-full h-full object-cover rounded-full hidden" src="" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="flex items-center whitespace-nowrap gap-3 mt-4">
                                    <label class="text-sm w-1/4" for="name">Tên danh mục</label>
                                    <input type="text" id="name" name="name" class="text-sm p-3 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Tên danh mục" required>
                                </div>
                                <input type="hidden" name="genre_id" value="{{ $genreId }}">
                                <div class="flex justify-center mt-4">
                                    <button id="submit" type="submit" class="py-3 px-7 w-44 font-bold inline-flex justify-center items-center text-sm rounded-full border border-transparent bg-green-500 text-white hover:bg-green-600 duration-100">
                                        Lưu
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-300">
                <tr>
                    <th scope="col" class="w-1/12 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th scope="col" class="w-1/6 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ảnh</th>
                    <th scope="col" class="w-1/2 px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tên danh mục</th>
                    <th scope="col" class="w-1/4 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase">Hành động</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($categories as $category)
                    <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                        <td class="px-2 py-3 whitespace-nowrap text-center text-sm font-medium text-gray-800">#{{ $category->id }}</td>
                        <td class="px-2 py-3 flex justify-center items-center text-sm text-gray-800">
                            <div class="w-16 h-16 flex justify-center items-center">
                                <img src="{{ Storage::url($category->image->path) }}" alt="{{ $category->name }}">
                            </div>
                        </td>
                        <td class="px-2 py-3 text-sm text-gray-800">
                            <div class="line-clamp-3">{{ $category->name }}</div></td>
                        <td class="px-2 py-3">
                            <div class="flex justify-center items-center gap-3">
                                <button type="button" data-id="{{ $category->id }}" class="whitespace-nowrap py-2 px-4 inline-flex items-center justify-center text-sm font-semibold rounded-lg border border-transparent text-blue-500 bg-blue-100 hover:bg-blue-200" data-hs-overlay="#modal-update">
                                    Sửa
                                </button>
                                <button type="button" onclick='event.preventDefault(); if (confirm("Bạn có chắc chắn xóa danh mục này?")) this.nextElementSibling.submit()' class="whitespace-nowrap py-2 px-4 inline-flex items-center justify-center text-sm font-semibold rounded-lg border border-transparent text-red-500 bg-red-100 hover:bg-red-200">
                                    Xóa
                                </button>
                                <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modal-update" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-hidden pointer-events-none [--body-scroll:true]">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-16 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
        <div class="flex w-full flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                <h3 class="font-bold text-gray-800 dark:text-white">
                    Sửa danh mục
                </h3>
                <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#modal-update">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-y-auto">
                <form id="update-category" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col">
                        <div id="content-form"></div>
                        <div class="flex items-center whitespace-nowrap gap-3 mt-4">
                            <label class="text-sm w-1/4 text-end" for="name">Thể loại</label>
                            <select id="genre" name="genre_id" class="w-full py-3 px-4 pe-9 block border-gray-300 rounded-lg text-sm focus:border-primary focus:ring-0 focus:outline-primary">
                                <option disabled value>Chọn</option>
                                @foreach($genres as $genre)
                                    <option @if($genre->id == $genreId) selected @endif value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-center mt-4">
                            <button id="submit" type="submit" class="py-3 px-7 w-44 font-bold inline-flex justify-center items-center text-sm rounded-full border border-transparent bg-green-500 text-white hover:bg-green-600 duration-100">
                                Lưu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
