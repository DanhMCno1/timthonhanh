<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    protected CategoryRepositoryInterface $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = $this->categoryRepo->create($request->only('name', 'genre_id'));

            $category->image()->create([
                'path' => $request->file('image')->store('public/categories'),
            ]);
            DB::commit();

            return response()->json(['success' => "Thêm danh mục mới thành công."]);
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return response()->json(['error' => "Lỗi không thêm được danh mục."]);
        }
    }

    public function edit(Category $category): JsonResponse
    {
        return response()->json([
            'view' => view('admins.category.edit', compact('category'))->render(),
        ]);
    }

    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        try {
            DB::beginTransaction();
            $category->update($request->only('name', 'genre_id'));

            if ($request->hasFile('image')) {
                Storage::delete($category->image->path);
                $category->image()->update([
                    'path' => $request->file('image')->store('public/categories'),
                ]);
            }
            DB::commit();

            return response()->json(['success' => "Sửa thông tin danh mục $category->id thành công."]);
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return response()->json(['error' => "Lỗi sửa thông tin danh mục."]);
        }
    }

    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();
            Storage::delete($category->image->path);
            $category->image->delete();
            $category->delete();
            DB::commit();

            return redirect()->route('admin.genres.index')->with('success', "Xóa danh mục #$category->id thành công");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->route('admin.genres.index')->with('error', "Xóa danh mục #$category->id thất bại");
        }
    }
}
