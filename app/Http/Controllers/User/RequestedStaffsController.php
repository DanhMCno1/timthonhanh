<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Feedback\FeedbackRepositoryInterface;
use App\Repositories\Request\RequestRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class RequestedStaffsController extends Controller
{
    protected RequestRepositoryInterface $requestRepo;
    protected FeedbackRepositoryInterface $feedbackRepo;

    public function __construct(RequestRepositoryInterface $requestRepo, FeedbackRepositoryInterface $feedbackRepo)
    {
        $this->requestRepo = $requestRepo;
        $this->feedbackRepo = $feedbackRepo;
    }

    public function index()
    {
        $user_id = Auth::id();
        $requests = $this->requestRepo->getRequestByUser($user_id);

        $listStaff = $this->feedbackRepo->getStaffByUser($user_id);

        return view('users.requested-staffs', compact('requests', 'listStaff'));
    }

}
