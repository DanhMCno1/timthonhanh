<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        return $this->categoryRepo->getCategories();
    }
}
