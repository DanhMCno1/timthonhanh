<?php

namespace App\Repositories\Feedback;
use App\Repositories\RepositoryInterface;

interface FeedbackRepositoryInterface extends RepositoryInterface
{
    public function getStaffByUser($userId);
    public function getFeedbackByStaff($staffId);
    public function getFeedback();
}
