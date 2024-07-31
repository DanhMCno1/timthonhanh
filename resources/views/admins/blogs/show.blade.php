<x-admin-layout>
    <x-slot name="header">
        Thêm blogs
    </x-slot>
    <div>
        <div class="font-bold text-2xl text-center">Thêm blogs</div>
        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300">
                <form id="blogForm" action="{{route('admin.blogs.store')}}" method="POST" class="w-3/5 m-auto border-2 py-4 px-10 rounded-lg" enctype="multipart/form-data">
                    @csrf
                    <div class="pb-7">
                        <div class="mt-7">
                            <label for="title" class="block text-sm mb-2 font-semibold">Tiêu đề</label>
                            <div class="flex rounded-lg">
                                <input id="title" name="title" onkeyup="ChangeToSlug()" class="px-4 block w-full border-gray-200 rounded-lg placeholder-gray-400" placeholder="Nhập tiêu đề">
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="slug" class="block text-sm mb-2 font-semibold">Slug</label>
                            <div class="flex rounded-lg">
                                <input id="slug" name="slug" class="px-4 block w-full border-gray-200 rounded-lg placeholder-gray-400 focus:ring-0 focus:border-gray-200" readonly>
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="summary" class="block text-sm mb-2 font-semibold">Tóm tắt</label>
                            <div class="flex rounded-lg">
                                <input id="summary" name="summary" class="px-4 block w-full border-gray-200 rounded-lg placeholder-gray-400 " placeholder="Tóm tắt">
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="image" class="block text-sm mb-2 font-semibold">Hình ảnh</label>
                            <div class="relative">
                                <input type="file" name="image" id="input-image" class="hidden">
                                <div id="image-preview-contain" class="w-96 h-64 flex items-center justify-center cursor-pointer ">
                                    <i id="icon-upload" class="text-9xl fa-solid fa-cloud-arrow-up"></i>
                                    <img id="image-preview" class="w-full h-full object-cover rounded-lg hidden" src="" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="content" class="block text-sm mb-2 font-semibold">Nội dung</label>
                            <textarea id="content" name="content"></textarea>
                        </div>
                        <div class="mt-7">
                            <label for="status" class="block text-sm font-semibold">Trạng thái</label>
                            <div class="flex gap-x-6 rounded-lg h-12">
                                <div class="flex items-center">
                                    <input type="radio" name="status" value="0" class="w-5 h-5" id="display">
                                    <label for="display" class="ms-2">Hiển thị</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="status" value="1" class=" w-5 h-5" id="hidden">
                                    <label for="hidden" class="ms-2">Ẩn</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-7">
                        <button id="createblog" type="submit" class="py-3 px-4 w-36 mb-5 inline-flex justify-center font-bold items-center gap-x-2 rounded-full border border-transparent bg-green-500 text-white hover:bg-green-700 cursor-pointer">
                            Tạo blog
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<x-slot name="script">
    <script type="module">
        CKEDITOR.replace('content' , {
            height : 500,
            toolbar: [
                '/',
                ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
                '/',
                ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
            ]
        });
    </script>
</x-slot>
</x-admin-layout>

