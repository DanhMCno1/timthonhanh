<x-user-layout>
    <x-slot name="header">
        Lịch sử gửi yêu cầu thợ
    </x-slot>
    
    <div class="bg-white shadow rounded-t-md min-h-[80vh] mt-3">
        <h2 class="font-bold flex items-center space-x-2 p-4 border-b">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
            </svg>
            <span>
                Lịch sử gửi yêu cầu thợ 
                <span class="text-sm">({{ count($requests) }})</span>
            </span>
        </h2>
        @foreach ($requests as $request)
            <div class="p-4 space-y-3">
                <div class="border rounded-lg p-3 hover:shadow">
                    <div class="text-sm">Bạn đã gửi yêu cầu <span class="font-bold text-primary-user">{{ $request->category->name }}</span> tới thợ <span class="font-bold text-primary-user">{{ $request->staff->name }}</span></div>
                    <div class="flex justify-between items-end space-y-2">
                        <div class="text-xs text-gray-400">Vào lúc {{ $request->created_at->format('h:m') }} ngày {{ $request->created_at->format('d/m/Y') }}</div>

                        <div class="flex">
                            <div class="py-1 mr-4 rounded-lg bg-gray-100 hover:bg-gray-300">
                                <a href="{{ route('chat.show', $request->id) }}" class="space-x-1 flex justify-between text-xs px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                      </svg>                                      
                                    <span class="pl-1 font-semibold">Nhắn tin với thợ</span>
                                </a>
                            </div>
                                @if ($request->status == 1)
                                    <div class="py-1 rounded-lg bg-gray-100 hover:bg-gray-300">
                                        <a href="{{ route('feedback-staff.index', $request->id) }}" class="space-x-1 flex justify-between text-xs px-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-orange-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"></path>
                                            </svg>
                                            @if (in_array($request->staff_id, $listStaff))
                                                <span class="pl-1 font-semibold">Xem đánh giá</span>
                                            @else
                                                <span class="pl-1 font-semibold">Đánh giá</span>
                                            @endif
                                        </a>
                                    </div>
                                @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-user-layout>
