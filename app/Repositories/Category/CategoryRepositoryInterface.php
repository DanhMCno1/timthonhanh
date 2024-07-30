<?php

namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getCategories();

    public function getCategoriesByGenre($genreId);
}
