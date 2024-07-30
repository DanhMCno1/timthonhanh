<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Request\RequestRepositoryInterface;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected MessageRepositoryInterface $messageRepo;
    protected RequestRepositoryInterface $requestRepo;

    public function __construct(
        MessageRepositoryInterface $messageRepo,
        RequestRepositoryInterface $requestRepo
    ) {
        $this->messageRepo = $messageRepo;
        $this->requestRepo = $requestRepo;
    }

    public function index() {
        $requests = $this->requestRepo->getRequestHasMessage();
        return view('admins.chats', compact('requests'));
    }

    public function show(ModelsRequest $modelsRequest) {
        $messages = $this->messageRepo->getMessageAndPaginate($modelsRequest->id, 1);

        return response()->json([
            'view' => view('admins.chats.show', compact( 'modelsRequest', 'messages'))->render(),
            'additional_view' => view('admins.chats.messages', compact( 'modelsRequest', 'messages'))->render(),
        ]);
    }

    public function load(ModelsRequest $modelsRequest, $page) {
        $messages = $this->messageRepo->getMessageAndPaginate($modelsRequest->id, $page);

        return response()->json([
            'view' => view('admins.chats.messages', compact( 'modelsRequest', 'messages'))->render(),
        ]);
    }
}
