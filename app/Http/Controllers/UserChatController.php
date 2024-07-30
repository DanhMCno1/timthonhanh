<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\User;
use App\Repositories\Message\MessageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserChatController extends Controller
{
    protected MessageRepositoryInterface $messageRepo;

    public function __construct(MessageRepositoryInterface $messageRepo)
    {
        $this->messageRepo = $messageRepo;
    }

    public function show(ModelsRequest $modelsRequest)
    {
        if ($modelsRequest->user_id !== auth()->user()->id) {
            return redirect(route('user.home'))->with('error', 'Bạn không có quyền gửi tin nhắn.');
        }
        return view('users.chat', compact('modelsRequest'));
    }

    public function index(ModelsRequest $modelsRequest, Request $request): JsonResponse
    {
        $messages = $this->messageRepo->getMessagesByRequest($modelsRequest->id, $request->get('quantity'));

        return response()->json([
            'view' => view('users.message.index', compact( 'modelsRequest', 'messages'))->render(),
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
                'sender_id' => auth()->id(),
                'sender_type' => User::class,
                'message' => $request->get('message'),
            ]);

            return response()->json(['success' => 'Gửi tin nhắn thành công.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['error' => 'Chưa gửi được tin nhắn'], 500);
        }
    }
}
