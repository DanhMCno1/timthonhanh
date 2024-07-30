<?php

namespace App\Repositories\Feedback;

use App\Models\Feedback;
use App\Repositories\BaseRepository;

class FeedbackRepository extends BaseRepository implements FeedbackRepositoryInterface
{
    public function getModel(): string
    {
        return Feedback::class;
    }

    public function getFeedbackByStaff($staffId)
    {
        return $this->model->where('staff_id', $staffId)->get();
    }

    public function getStaffByUser($userId)
    {
        return $this->model->where('user_id', $userId)->pluck('staff_id')->all();
    }

    public function getFeedback()
    {
        return $this->model->orderBy('created_at', 'desc')->take(5)->get();
    }
}
