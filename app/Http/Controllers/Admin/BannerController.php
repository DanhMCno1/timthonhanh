<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Repositories\Banner\BannerRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BannerController extends Controller
{
    protected BannerRepositoryInterface $bannerRepo;

    public function __construct(BannerRepositoryInterface $bannerRepo)
    {
        $this->bannerRepo = $bannerRepo;
    }

    public function index(): View
    {
        $banners = $this->bannerRepo->getAll();
        return view('admins.banner', compact('banners'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'image.required' => 'Chưa chọn ảnh.',
            'image.image' => 'Hãy chọn file ảnh.',
            'image.mimes' => 'Hãy chọn ảnh có định dạng jpg, jpeg hoặc png.',
            'image.max' => 'Kích thước ảnh quá lớn (>2048KB).',
        ]);

        try {
            DB::beginTransaction();
            $banner = $this->bannerRepo->create();
            $banner->image()->create([
                'path' => $request->file('image')->store('public/banners'),
            ]);
            DB::commit();

            return back()->with('success', 'Thêm banner thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());

            return back()->with('error', 'Thêm banner thất bại.');
        }
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        try {
            Storage::delete($banner->image->path);
            $banner->image->delete();
            $banner->delete();
            DB::commit();

            return back()->with('success', "Xóa banner thành công.");
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());

            return back()->with('error', "Xóa banner thất bại.");
        }
    }
}
