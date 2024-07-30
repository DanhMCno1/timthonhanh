<x-user-layout>
    <x-slot name="header">
        Quên mật khẩu
    </x-slot>
    
    <div class="py-10 px-7 min-h-[75vh] bg-base-100 mt-3 bg-white shadow rounded border rounded-t-md">
        <h3 class="text-center font-medium text-3xl">Đổi mật khẩu</h3>
        <div class="mt-3 text-[16px] font-semibold">
            <span>
                Bạn vui lòng nhập số điện thoại đã đăng ký. Hệ thống sẽ gửi hướng
                dẫn đổi mật khẩu vào điện thoại
            </span>
        </div>
        <form method="POST" action="{{ route('submit-otp') }}">
            @csrf
            <div class="py-7 space-y-2">
                <div class="form-control">
                    <span class="label-text">Số điện thoại
                        <span class="text-red-600 ms-1">*</span>
                    </span>
                </div>
                <div class="flex flex-col rounded-lg">
                    <div class="flex">
                        <input type="text" value="{{ old('phone') }}" inputmode="numeric" id="inputPhone" name="phone"
                               class="p-1 px-4 block w-full border-gray-200 shadow-sm rounded-s-lg focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                               placeholder="Số điện thoại">
                        <button type="submit" id="btnSendOTP"
                                class="p-1 px-4 inline-flex justify-center items-center gap-x-2 min-w-[90px]  min-h-[50px] text-sm font-semibold rounded-e-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                disabled>
                            Gửi OTP
                        </button>
                    </div>
                    <span id="inputPhoneErr" class="text-red-700 text-sm mt-1 hidden"></span>
                </div>
                    <div class="space-y-2">
                        <span class="label-text mt-1">OTP<span class="text-red-600 ms-1">*</span></span>
                        <div class="space-y-3">
                            <input type="number" id="inputOTP" inputmode="numeric" name="phone_otp"
                                   class="py-3 px-4 border w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="OTP">
                        </div>
                        @error('otp')
                        <span id="inputOTPErr" class="text-red-700 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-center !mt-10">
                        <button id="" type="submit"
                                class="min-w-[170px] mt-5 py-3 px-7 rounded-full text-base bg-blue-700 text-white hover:bg-blue-800 disabled:opacity-50 disabled:pointer-events-none">
                            Gửi
                        </button>
                    </div>
                </div>
        </form>
    </div>
    <x-slot name="script">
        @vite('resources/js/user/forget-password-form.js')
        <script type="module">
            //Send OTP
            $("#btnSendOTP").on("click", function (e) {
                e.preventDefault();
                let phone = $("#inputPhone").val();
                $.ajax({
                    url: "{{ route('otp.send') }}",
                    type: "POST",
                    data: {
                        phone: phone,
                        role: "user",
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        toastr.success(response.message);
                    },
                    error: function (xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    },
                });
            });
        </script>
    </x-slot>
</x-user-layout>
