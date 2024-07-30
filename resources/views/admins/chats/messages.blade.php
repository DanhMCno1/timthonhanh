<div class="flex justify-center items-center">
    <div id="loadingMessage" class="animate-spin hidden size-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full" role="status" aria-label="loading">
        <span class="sr-only">Loading...</span>
    </div>
</div>

@foreach($messages->reverse() as $message)
    @if($message->sender_type === 'App\Models\User')
        <div class="col-start-6 col-end-13 p-3 rounded-lg">
            <div class="flex flex-row items-center transition-all duration-500 item">
                <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                        <span class="inline-flex items-center uppercase justify-center size-10 rounded-full bg-gray-500 font-semibold text-white leading-none">
                            {{ substr($modelsRequest->user->name, 0, 1) }}
                        </span>
                    </div>
                    <span class="text-sm text-center text-gray-500">{{ $modelsRequest->user->name }}</span>
                </div>
                <div class="ml-3 text-sm bg-gray-100 py-2 px-4 shadow rounded-xl">
                    <div>{!! nl2br(e($message->message)) !!}</div>
                </div>
            </div>
        </div>
    @else
        <div data-id="{{ $message->id }}" class="col-start-1 col-end-8 p-3">
            <div class="flex items-center justify-start flex-row-reverse transition-all duration-500 item">
                <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-center h-10 w-10 overflow-hidden rounded-full bg-indigo-500 flex-shrink-0">
                        <img class="w-full h-full" src="{{ Storage::url($modelsRequest->staff->image->path) }}" alt="">
                    </div>
                    <span class="text-sm text-center text-gray-500">{{ $modelsRequest->staff->name }}</span>
                </div>
                <div class="mr-3 text-sm bg-gray-100 py-2 px-4 shadow rounded-xl">
                    <div>{!! nl2br(e($message->message)) !!}</div>
                </div>
            </div>
        </div>
    @endif
@endforeach