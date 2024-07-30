<div id="tabs-0" role="tabpanel" aria-labelledby="tabs-item-0">
    @foreach($requests as $request)
        <div class="border border-primary rounded mb-2" style="--tw-border-opacity: 0.1;">
            <div class="p-2 font-medium text-sm flex justify-between bg-primary items-center" style="--tw-bg-opacity: 0.1;">
                <div class="flex items-center space-x-1">
                    <span>Yêu cầu: {{ $request->category->name }}</span>
                    @if(!$request->status)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"></path></svg>
                    @endif
                </div>
                <span class="text-xs text-primary font-normal" style="--tw-text-opacity: 0.75;">
                {{ date_format($request->created_at, 'd/m/y H:i') }}
            </span>
            </div>
            <div class="flex justify-between text-sm p-2">
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"></path>
                    </svg>
                    <span class="!line-clamp-1">
                        @if(!$request->status)
                            ***,
                        @else
                            {{ $request->user->hamlet }},
                            {{ $request->user->ward->name }},
                        @endif
                        {{ $request->user->district->name }},
                        {{ $request->user->province->name }}
                    </span>
                </div>
                <a href="{{ route('staff.requests.show', ['request' => $request->id]) }}" class="w-28 flex justify-end link link-primary items-center space-x-1">
                    <span class="text-primary underline whitespace-nowrap hover:text-orange-700 duration-200 w-[45px]">Chi tiết</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    @endforeach
</div>
{{ $requests->links('layouts.pagination', ['role' => 'staff']) }}
