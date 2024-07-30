<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Genre;
use Illuminate\Http\Request;

class CategoriesListController extends Controller
{
    public function categoriesList()
    {
        $categories = Category::with('image')->inRanDomOrder()->limit(10)->get();
        $genres = Genre::with('categories')->get();
        return view('users.categories-list', compact('genres','categories'));
    }
}
