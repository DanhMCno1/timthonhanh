<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::orderBy('created_at','desc')->paginate(5);
        return view('admins.blogs', compact('blogs'));
    }
    public function create() {
        return view('admins.blogs.show');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $blog = Blog::create([
                'title' => $request->get('title', ''),
                'content' => $request->get('content', ''),
                'status' => $request->get('status', ''),
                'summary' => $request->get('summary', ''),
                'slug' => $request->get('slug', ''),

            ]);
            // Create path image
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/blogs');
                $blog->image()->create(['path' => $path]);
            }

            DB::commit();

            return redirect()->route('admin.blogs.index')->with('success', 'Tạo blog mới thành công!');

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'errors' => ['error' => $e->getMessage()],
            ], 500);
        }
    }

    public function edit($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('admins.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->summary = $request->input('summary-update');
        $blog->content = $request->input('content-update');
        $blog->status = $request->input('status-update');
        $blog->slug = $request->input('slug');

        // Process uploaded images
        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image) {
                Storage::delete($blog->image->path);
                $blog->image->delete();
            }

            // Save new image
            $path = $request->file('image')->store('public/blogs');
            $blog->image()->create(['path' => $path]);
        }

        $blog->save();
        if ($request->ajax()) {
            return response()->json([
                'success' => 'Cập nhật blog thành công!',
            ]);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Cập nhật blog thành công!');
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Delete image
            if ($blog->image) {
                Storage::delete($blog->image->path);
                $blog->image->delete();
            }

            $blog->delete();

            return redirect()->route('admin.blogs.index')->with('success', 'Xóa blog thành công!');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
