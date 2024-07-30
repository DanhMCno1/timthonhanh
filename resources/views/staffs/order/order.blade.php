<x-staff-layout>
    <x-slot name="header">Mua yêu cầu công việc</x-slot>

    <div class="border min-h-[66vh] mt-3 bg-white rounded">
        <h1 class="font-extrabold py-4 px-5 rounded-t-lg border-b text-lg flex justify-between items-center">
            <b>Mua lượt xem yêu cầu</b>
            <a href="{{ route('staff.order.history') }}" class="px-2 h-6 hover:bg-gray-300 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                </svg>
            </a>
        </h1>
        <form action="{{ route('staff.order.store') }}" method="POST">
            @csrf
            <div class="p-5">
                <h1 class="font-bold mb-4">Chọn số lượt xem</h1>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($buyRequests as $buyRequest)
                        @php
                            $amount = $buyRequest->amount;
                            $price = $buyRequest->price;
                            $discount = $buyRequest->discount;
                            $discountPrice = $buyRequest->discountPrice;
                        @endphp
                        <label for="amount-{{ $amount }}" class="bg-[#f2f2f2] rounded-lg">
                            <div class="justify-start flex items-center font-bold gap-2 cursor-pointer px-4 py-2 pb-3 relative">
                                <input type="radio" data-amount="{{ $amount }}" data-price="{{ $discountPrice }}" id="amount-{{ $amount }}" name="buy_request_id" class="border-2 shrink-0 border-black rounded-full text-black focus:ring-0 ring-offset-0 focus:ring-offset-0 focus:ring-s w-6 h-6 checked:bg-none checked:shadow-radio-mark" value="{{ $buyRequest->id }}">
                                <div>
                                    <p class="text-sm">{{ $amount }} lượt xem</p>
                                    <p class="text-start text-red-700 text-[9px] leading-[8px]">
                                        {{ number_format($discountPrice, 0, '', '.') }} ₫
                                        @if($discountPrice != $price)
                                            <span class="line-through text-gray-400">{{ number_format($price, 0, '', '.') }} ₫</span>
                                        @endif
                                    </p>
                                </div>
                                @if($discount)
                                    <label class="bg-red-500 sm:text-xs text-[10px] text-white rounded-[2px] flex justify-center absolute top-0 right-0 px-1">{{ $discount }}% giảm</label>
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('buy_request_id')
                    <div class="text-sm text-[#dc2626] mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="p-5">
                <div class="flex justify-center">
                    <button id="submit" type="submit" class="py-3 px-4 w-full inline-flex justify-center font-bold items-center gap-x-2 rounded-lg border border-transparent bg-blue-500 text-sm text-white hover:bg-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-5 h-5 mr-1">
                            <path d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zM272 192H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H272c-8.8 0-16-7.2-16-16s7.2-16 16-16zM256 304c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H272c-8.8 0-16-7.2-16-16zM164 152v13.9c7.5 1.2 14.6 2.9 21.1 4.7c10.7 2.8 17 13.8 14.2 24.5s-13.8 17-24.5 14.2c-11-2.9-21.6-5-31.2-5.2c-7.9-.1-16 1.8-21.5 5c-4.8 2.8-6.2 5.6-6.2 9.3c0 1.8 .1 3.5 5.3 6.7c6.3 3.8 15.5 6.7 28.3 10.5l.7 .2c11.2 3.4 25.6 7.7 37.1 15c12.9 8.1 24.3 21.3 24.6 41.6c.3 20.9-10.5 36.1-24.8 45c-7.2 4.5-15.2 7.3-23.2 9V360c0 11-9 20-20 20s-20-9-20-20V345.4c-10.3-2.2-20-5.5-28.2-8.4l0 0 0 0c-2.1-.7-4.1-1.4-6.1-2.1c-10.5-3.5-16.1-14.8-12.6-25.3s14.8-16.1 25.3-12.6c2.5 .8 4.9 1.7 7.2 2.4c13.6 4.6 24 8.1 35.1 8.5c8.6 .3 16.5-1.6 21.4-4.7c4.1-2.5 6-5.5 5.9-10.5c0-2.9-.8-5-5.9-8.2c-6.3-4-15.4-6.9-28-10.7l-1.7-.5c-10.9-3.3-24.6-7.4-35.6-14c-12.7-7.7-24.6-20.5-24.7-40.7c-.1-21.1 11.8-35.7 25.8-43.9c6.9-4.1 14.5-6.8 22.2-8.5V152c0-11 9-20 20-20s20 9 20 20z"/></svg>
                        Thanh toán qua Visa
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-staff-layout>
