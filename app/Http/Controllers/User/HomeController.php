<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Genre;
use App\Repositories\Feedback\FeedbackRepositoryInterface;
use App\Repositories\Banner\BannerRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected FeedbackRepositoryInterface $feedbackRepo;
    protected BannerRepositoryInterface $bannerRepo;

    public function __construct(FeedbackRepositoryInterface $feedbackRepo, BannerRepositoryInterface $bannerRepo)
    {
        $this->feedbackRepo = $feedbackRepo;
        $this->bannerRepo = $bannerRepo;
    }

    public function index()
    {
        $feedbacks = $this->feedbackRepo->getFeedback();
        $categories = Category::with('image')->inRanDomOrder()->limit(10)->get();
        $genres = Genre::all();
        $banners = $this->bannerRepo->getAll();

        return view('users.index', compact('genres', 'categories', 'banners', 'feedbacks'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->take(10)->get();

        return response()->json($categories);
    }
}
