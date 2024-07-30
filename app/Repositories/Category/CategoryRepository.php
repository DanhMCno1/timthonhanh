<?php

namespace App\Repositories\Category;
use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getCategories()
    {
        return $this->model->pluck('name', 'id')->all();
    }

    public function getCategoriesByGenre($genreId)
    {
        return $this->model
            ->where('genre_id', $genreId)
            ->get();
    }
}
