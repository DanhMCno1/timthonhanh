<?php

namespace App\Repositories\WorkArea;
use App\Models\WorkArea;
use App\Repositories\BaseRepository;

class WorkAreaRepository extends BaseRepository implements WorkAreaRepositoryInterface
{
    public function getModel(): string
    {
        return WorkArea::class;
    }

    public function updateOrCreate($staffId, $attributes = [])
    {
        $workAreas =  $this->model->where('staff_id', $staffId)->get();
        foreach ($workAreas as $key => $workArea) {
            if (array_key_exists($key, $attributes)) {
                $workArea->update($attributes[$key]);
                unset($attributes[$key]);
            } else {
                $this->delete($workArea->id);
            }
        }
        foreach ($attributes as $attribute) {
            $this->create($attribute);
        }
    }
}
