@foreach($messages as $message)
    @if($message->sender_type === 'App\Models\User')
        <div class="col-start-1 col-end-8 p-3">
            <div class="flex flex-row items-center">
                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                    <span class="inline-flex items-center justify-center size-10 rounded-full bg-gray-500 font-semibold text-white leading-none">
                        {{ substr($modelsRequest->user->name, 0, 1) }}
                    </span>
                </div>
                <div class="ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                    <div>{!! nl2br(e($message->message)) !!}</div>
                </div>
            </div>
        </div>
    @else
        <div data-id="{{ $message->id }}" class="col-start-6 col-end-13 p-3 rounded-lg">
            <div class="flex items-center justify-start flex-row-reverse">
                <div class="flex items-center justify-center h-10 w-10 overflow-hidden rounded-full bg-indigo-500 flex-shrink-0">
                    <img class="w-full h-full" src="{{ Storage::url($modelsRequest->staff->image->path) }}" alt="">
                </div>
                <div class="mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                    <div>{!! nl2br(e($message->message)) !!}</div>
                </div>
            </div>
        </div>
    @endif
@endforeach
