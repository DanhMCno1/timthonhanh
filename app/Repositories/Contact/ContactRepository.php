<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    public function getModel(): string
    {
        return Contact::class;
    }

    public function getContact($search, $column)
    {
        if (!Schema::hasColumn($this->model->getTable(), $column)) {
            $column = 'fullname';
        }

        return $this->model
            ->when($search, function ($query) use ($search, $column) {
                return $query->where($column, 'like', '%' . $search . '%');
            })
            ->orderBy('status')
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
}
