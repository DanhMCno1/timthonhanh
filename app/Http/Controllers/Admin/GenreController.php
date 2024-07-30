<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Genre\GenreRepositoryInterface;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    protected $genreRepo;
    protected $categoryRepo;

    public function __construct(GenreRepositoryInterface $genreRepo, CategoryRepositoryInterface $categoryRepo)
    {
        $this->genreRepo = $genreRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index(Request $request)
    {
        if ($request->has('genre_id')) {
            $genreId = $request->get('genre_id');

            $genres = $this->genreRepo->getAll();
            $categories = $this->categoryRepo->getCategoriesByGenre($genreId);

            return response()->json([
                'view' => view('admins.category.index', compact('categories', 'genres', 'genreId'))->render(),
            ]);
        }

        $genres = $this->genreRepo->getAll();

        return view('admins.genres', compact('genres'));
    }
}
