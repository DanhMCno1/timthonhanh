<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\FeedbackRequest;
use App\Models\Staff;
use App\Repositories\Feedback\FeedbackRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FeedbackStaffController extends Controller
{
    protected FeedbackRepositoryInterface $feedbackRepo;
    protected $user;

    public function __construct(FeedbackRepositoryInterface $feedbackRepo)
    {
        $this->feedbackRepo = $feedbackRepo;
        $this->user = Auth::user();
    }

    public function index(Staff $staff)
    {
        $feedbacks = $this->feedbackRepo->getFeedbackByStaff($staff->id);
        $feedback = $this->feedbackRepo->findByAttributes(['user_id'=>$this->user->id, 'staff_id'=>$staff->id]);
        $listStaff = $this->feedbackRepo->getStaffByUser($this->user->id);
        if ($listStaff) {
            return view('users.feedback-show', compact('staff', 'feedback'));
        }

        return view('users.feedback-staff', compact('staff', 'feedbacks'));
    }

    public function store(FeedbackRequest $request, Staff $staff)
    {
        try {
            DB::beginTransaction();
            $feedback = $this->feedbackRepo->create([
                "category_id" => $request->input('category'),
                "rating" => $request->input('rating'),
                "user_id" => $this->user->id,
                "staff_id" => $staff->id,
                "comment" => $request->input('comment'),
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('public/feedbacks');
                    $feedback->images()->create([
                        'path' => $path,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['message' => 'Đánh giá thợ thành công!']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['message' => 'Đánh giá thợ thất bại']);
        }
    }
}
