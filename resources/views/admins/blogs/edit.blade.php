<x-admin-layout>
    <x-slot name="header">
        Chỉnh sửa Blog
    </x-slot>
    <div>
        <div class="font-bold text-2xl text-center"> Chỉnh sửa Blog</div>
        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-blue-300">
                <form id="updateBlog" action="{{route('admin.blogs.update', $blog->id)}}" method="POST" class="w-3/5 m-auto border-2 py-4 px-10 rounded-lg" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="pb-7">
                        <div class="mt-7">
                            <label for="title" class="block text-sm mb-2 font-semibold">Tiêu đề</label>
                            <div class="flex rounded-lg">
                                <input id="title" name="title" onkeyup="ChangeToSlug()" value="{{ $blog->title }}" class="px-4 block w-full border-gray-200 rounded-lg placeholder-gray-400" placeholder="Nhập tiêu đề">
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="slug" class="block text-sm mb-2 font-semibold">Slug</label>
                            <div class="flex rounded-lg">
                                <input id="slug" value="{{ $blog->slug }}" name="slug" class="px-4 block w-full border-gray-200 rounded-lg placeholder-gray-400" >
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="summary-update" class="block text-sm mb-2 font-semibold">Tóm tắt</label>
                            <div class="flex rounded-lg">
                                <input id="summary-update" name="summary-update" value="{{ $blog->summary }}" class="px-4 block w-full border-gray-200 rounded-lg placeholder-gray-400 " placeholder="Tóm tắt">
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="image" class="block text-sm mb-2 font-semibold">Hình ảnh</label>
                            <div class="relative">
                                <input type="file" name="image" id="input-image" class="hidden">
                                <div id="image-preview-contain" class="w-96 h-64 flex items-center justify-center cursor-pointer">
                                    <img id="image-preview" class="w-full h-full rounded-xl border-2 " src="{{ Storage::url($blog->image->path) }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="mt-7">
                            <label for="content-update" class="block text-sm mb-2 font-semibold">Nội dung</label>
                            <textarea id="content-update" name="content-update">{{$blog->content}}</textarea>
                        </div>
                        <div class="mt-7">
                            <label for="status-update" class="block text-sm font-semibold">Trạng thái</label>
                            <div class="flex gap-x-6 rounded-lg h-12">
                                <div class="flex items-center">
                                    <input type="radio" name="status-update" value="0" class="w-5 h-5" id="display" {{ $blog->status == 0 ? 'checked' : '' }}>
                                    <label for="display" class="ms-2">Hiển thị</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="status-update" value="1" class=" w-5 h-5" id="hidden" {{ $blog->status == 1 ? 'checked' : '' }}>
                                    <label for="hidden" class="ms-2">Ẩn</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-7">
                        <button id="editblog" type="submit" class="py-3 px-4 w-36 mb-5 inline-flex justify-center font-bold items-center gap-x-2 rounded-full border border-transparent bg-green-500 text-white hover:bg-green-700 cursor-pointer">
                            Chỉnh sửa blog
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="module">
            CKEDITOR.replace('content-update' , {
                height: 500,
                toolbar: [
                    '/',
                    ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
                    '/',
                    ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                    ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
                ]
            });
            $(document).ready(function () {
                window.appConfig = {
                    urls: {
                        blog: '{{ route('admin.blogs.index') }}',
                    },
                    values: {
                        role: '',
                    },
                    csrfToken: '{{ csrf_token() }}'
                };
            })
        </script>
    </x-slot>
</x-admin-layout>

