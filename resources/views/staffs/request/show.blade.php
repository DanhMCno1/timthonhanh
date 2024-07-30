<x-staff-layout>
    <x-slot name="header">
        Chi tiết yêu cầu công việc
    </x-slot>

    <div class="border mt-3 bg-white min-h-[75vh] rounded">
        <h2 class="font-bold text-lg py-4 px-5 rounded-t-lg border-b flex justify-between items-center">
            <span>Chi tiết yêu cầu công việc</span>
        </h2>
        <div class="p-4 space-y-4">
            <div class="text-primary text-sm flex items-center space-x-2">
                @if($request->status)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                    </svg>
                    <span>Thông tin đã được xem lúc {{ date_format($request->updated_at, 'd/m/Y H:i:s') }}</span>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"></path>
                    </svg>
                    <span>Thông tin người yêu cầu chưa được mở.</span>
                @endif
            </div>
            <div class="overflow-x-auto rounded border">
                <div class="divide-y divide-slate-200 text-sm">
                    <div class="grid grid-cols-3 items-center py-3 px-4">
                        <div class="font-bold">Mã yêu cầu:</div>
                        <div class="col-span-2">{{ $request->id }}</div>
                    </div>
                    <div class="grid grid-cols-3 items-center py-3 px-4">
                        <div class="font-bold">Người yêu cầu:</div>
                        <div class="col-span-2">{{ $request->user->name }}</div>
                    </div>
                    <div class="grid grid-cols-3 items-center py-3 px-4">
                        <div class="font-bold">Số điện thoại:</div>
                        <div class="col-span-2">{{ $request->user->phone }}</div>
                    </div>
                    <div class="grid grid-cols-3 items-center py-3 px-4">
                        <div class="font-bold">Địa chỉ:</div>
                        <div class="col-span-2">
                            @if(!$request->status)
                                ***,
                            @else
                                {{ $request->user->hamlet }},
                                {{ $request->user->ward->name }},
                            @endif
                            {{ $request->user->district->name }},
                            {{ $request->user->province->name }}
                        </div>
                    </div>
                    <div class="grid grid-cols-3 items-center py-3 px-4">
                        <div class="font-bold">Nội dung yêu cầu sửa chữa:</div>
                        <div class="col-span-2">
                            <span class="text-xs text-primary border rounded-lg py-1 px-2 border-primary font-bold cursor-default">{{ $request->category->name }}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 items-center py-3 px-4">
                        <div class="font-bold">Thời gian gửi yêu cầu:</div>
                        <div class="col-span-2">{{ date_format($request->created_at, 'd/m/Y H:i:s') }}</div>
                    </div>
                </div>
            </div>
            @if(!$request->status)
                <form action="{{ route('staff.requests.update', ['request' => $request]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="py-3 px-4 w-full inline-flex justify-center font-bold items-center text-sm gap-x-2 rounded-lg bg-primary text-white hover:bg-hover-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                        </svg>
                        <span>Xem thông tin người yêu cầu</span>
                    </button>
                </form>
            @else
                <a href="{{ route('staff.chat.show', $request) }}" class="py-3 px-4 w-full inline-flex justify-center font-bold items-center text-sm gap-x-2 rounded-lg bg-primary text-white hover:bg-hover-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>
                    <span>Nhắn tin với người yêu cầu</span>
                </a>
            @endif
        </div>
    </div>
</x-staff-layout>
