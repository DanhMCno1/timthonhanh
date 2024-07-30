@foreach($messages as $message)
    @if($message->sender_type === 'App\Models\User')
        <div class="col-start-1 col-end-8 p-3">
            <div class="flex flex-row-reverse items-center">
                <div class="ml-3 text-sm py-2 px-4 shadow rounded-xl bg-blue-200">
                    <div>{!! nl2br(e($message->message)) !!}</div>
                </div>
            </div>
        </div>
    @else
        <div class="col-start-6 col-end-13 p-3 rounded-lg">
            <div class="flex items-center justify-start flex-row gap-2">
                <div class="flex items-center justify-center h-10 w-10 overflow-hidden rounded-full flex-shrink-0">
                    <img class="w-full h-full" src="{{ Storage::url($modelsRequest->staff->image->path) }}" alt="">
                </div>
                <div class="mr-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                    <div>{!! nl2br(e($message->message)) !!}</div>
                </div>
            </div>
        </div>
    @endif
@endforeach
