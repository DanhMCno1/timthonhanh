<div class="flex justify-center">
    <label for="image-input-update" class="cursor-pointer">
        <input type="file" name="image" id="image-input-update" class="hidden">
        <div data-id="2" class="col border border-gray-300 rounded-lg overflow-hidden w-[120px] h-[120px] flex justify-center items-center">
            <img class="w-full h-full object-cover rounded-lg" src="{{ Storage::url($category->image->path) }}" alt="">
        </div>
    </label>
</div>
<div class="flex items-center whitespace-nowrap gap-3 mt-4">
    <label class="text-sm w-1/4" for="name">Tên danh mục</label>
    <input type="text" id="name" value="{{ $category->name }}" name="name" class="text-sm p-3 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Tên danh mục" required>
</div>
<input type="hidden" name="id" value="{{ $category->id }}">
