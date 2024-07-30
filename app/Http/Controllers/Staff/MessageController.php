<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use App\Models\Staff;
use App\Repositories\Message\MessageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MessageController extends Controller
{
    protected $messageRepo;

    public function __construct(MessageRepositoryInterface $messageRepo)
    {
        $this->messageRepo = $messageRepo;
    }

    public function show(ModelsRequest $modelsRequest)
    {
        if (!$modelsRequest->status || $modelsRequest->staff_id !== auth('staff')->user()->id) {
            return redirect(route('staff.home'))->with('error', 'Bạn không có quyền gửi tin nhắn.');
        }

        return view('staffs.chat', compact('modelsRequest'));
    }

    public function index(ModelsRequest $modelsRequest, Request $request): JsonResponse
    {
        $messages = $this->messageRepo->getMessagesByRequest($modelsRequest->id, $request->get('quantity'));

        return response()->json([
            'view' => view('staffs.message.index', compact( 'modelsRequest', 'messages'))->render(),
            'count' => $messages->count()
        ]);
    }

    public function store(ModelsRequest $modelsRequest, Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required',
        ], [
            'message.required' => 'Chưa nhập tin nhắn!'
        ]);

        try {
            $this->messageRepo->create([
                'request_id' => $modelsRequest->id,
                'sender_id' => auth('staff')->id(),
                'sender_type' => Staff::class,
                'message' => $request->get('message'),
            ]);

            return response()->json(['success' => 'Gửi tin nhắn thành công.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['error' => 'Chưa gửi được tin nhắn'], 500);
        }
    }
}
