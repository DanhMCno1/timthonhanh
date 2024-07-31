<x-staff-layout>
    <x-slot name="header">
        Mã giới thiệu
    </x-slot>
    <div class="mt-3 bg-white rounded border-b pb-6">
        <div class="flex justify-center">
            <h2 class="font-extrabold px-2 rounded-t-lg text-lg flex justify-center items-center">
                Mã Giới Thiệu
            </h2>
            <div class="">
                <div class="col-start-2 text-center">
                    <div class="hs-tooltip inline-block">
                        <button type="button" class="hs-tooltip-toggle size-7 inline-flex justify-center items-center gap-2 rounded-full bg-gray-50 border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 focus:outline-none focus:bg-blue-50 focus:border-blue-200 focus:text-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-white/10 dark:hover:border-white/10 dark:hover:text-white dark:focus:bg-white/10 dark:focus:border-white/10 dark:focus:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4"><path d="M80 160c0-35.3 28.7-64 64-64l32 0c35.3 0 64 28.7 64 64l0 3.6c0 21.8-11.1 42.1-29.4 53.8l-42.2 27.1c-25.2 16.2-40.4 44.1-40.4 74l0 1.4c0 17.7 14.3 32 32 32s32-14.3 32-32l0-1.4c0-8.2 4.2-15.8 11-20.2l42.2-27.1c36.6-23.6 58.8-64.1 58.8-107.7l0-3.6c0-70.7-57.3-128-128-128l-32 0C73.3 32 16 89.3 16 160c0 17.7 14.3 32 32 32s32-14.3 32-32zm80 320a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/></svg>
                            <span class="w-[560px] p-3 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                            Với mỗi lượt chia sẻ mã giới thiệu thành công, bạn sẽ nhận được thêm 20% tổng số lượt xem của tất cả các đơn hàng mà người sử dụng mã thanh toán sau này. Ngoài ra, mỗi tài khoản mới sử dụng mã giới thiệu của bạn cũng sẽ được tặng thêm 5 lượt xem miễn phí. Hãy cùng nhau chia sẻ để nhận thêm nhiều lợi ích nhé!
                    </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <small class="flex items-center justify-center mb-4 text-blue-500">
            <p class="text-red-500 mx-1 text-xl">*</p>
            Sử dụng mã giới thiệu thợ để cùng nhận nhiều phúc lợi
        </small>
        <div class="p-4 mt-5 text-center space-y-4 mb-10">
            <span class="p-4 bg-green-500 rounded-xl font-semibold text-white">{{ $referral_code }}</span>
        </div>

        {{-- list of people who entered referral code--}}
        @if($referrals->isNotEmpty())
            <div class="mb-10">
                <h3 class="font-bold mb-6 ml-6"> * Danh sách người dùng được giới thiệu:</h3>
                <div class="font-bold float-right mr-20 mb-6">Tổng: {{ $referralCount }} thợ</div>
                <div class="border rounded-xl w-4/5 m-auto overflow-hidden bg-blue-100 p-2">
                    @foreach($referrals as $referral)
                        <div class="flex justify-center items-center text-center ">
                            <div class="w-full overflow-hidden">
                                <div class="p-2">
                                    <span class="font-bold">#{{ $referral->id }}</span>
                                    <span class="">{{ $referral->name }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $referrals->links('layouts.pagination', ['role' => 'staff']) }}
            @else
            <div class="text-center min-h-36">
                <span >Chưa có thợ nào nhập mã giới thiệu của bạn</span>
            </div>
        @endif
    </div>

</x-staff-layout>
