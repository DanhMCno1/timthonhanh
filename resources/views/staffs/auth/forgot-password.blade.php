<x-staff-layout>
    <x-slot name="header">
        Quên mật khẩu
    </x-slot>

    <div class="py-5 px-7 border rounded-t-md min-h-[75vh] mt-3 bg-white shadow rounded">
        <h3 class="text-center font-medium text-3xl">Đổi mật khẩu</h3>
        <div class="mt-3 font-bold">
            <span>Bạn vui lòng nhập số điện thoại đã đăng ký. Hệ thống sẽ gửi hướng dẫn đổi mật khẩu vào điện thoại</span>
        </div>

        <form action="{{ route('staff.forgot-password.store') }}" method="post">
            @csrf

            <div class="mt-7">
                <label for="phone" class="block text-sm mb-2">Số điện thoại<span class="text-red-600 ms-1">*</span></label>
                <div class="flex rounded-lg h-12">
                    <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="p-4 block w-full border-gray-300 rounded-s-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Số điện thoại">
                    <button id="send-phone-otp" {{ old('phone') ? '' : 'disabled' }} type="button" class="w-28 rounded-e-lg bg-primary text-white hover:bg-hover-primary disabled:opacity-30 disabled:text-black disabled:bg-gray-500 disabled:pointer-events-none">
                        Gửi OTP
                    </button>
                </div>
                <div id="phone-error" class="hidden text-sm text-[#dc2626] mt-2" role="alert"></div>
                @error('phone')
                <div class="text-sm text-[#dc2626] mt-2" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div id="otp-input" class="mt-7 {{ old('phone_otp') ? '' : 'hidden' }}">
                <label for="phone-otp" class="block text-sm mb-2">OTP<span class="text-red-600 ms-1">*</span></label>
                <div class="flex rounded-lg h-12">
                    <input type="number" id="phone-otp" name="phone_otp" value="{{ old('phone_otp') }}" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary">
                </div>
            </div>
            @error('phone_otp')
            <div class="text-sm text-[#dc2626] mt-2" role="alert">
                {{ $message }}
            </div>
            @enderror

            <input type="hidden" name="role" value="staff">

            <div class="flex justify-center mt-7">
                <button id="submit" type="submit" {{ old('phone_otp') && old('phone') ? '' : 'disabled' }} class="py-3 px-4 w-28 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-primary text-white hover:bg-hover-primary disabled:opacity-30 disabled:text-black disabled:bg-gray-500 disabled:pointer-events-none">
                    Gửi
                </button>
            </div>
        </form>
    </div>

    <x-slot name="script">
        <script type="module">
            $(document).ready(function () {
                window.appConfig = {
                    urls: {
                        sendOtpUrl: '{{ route('otp.send') }}',
                    },
                    values: {
                        role: 'staff',
                    },
                    csrfToken: '{{ csrf_token() }}'
                };

                $('input').on('input', function () {
                    $('#submit').prop('disabled', !($('#phone').val() && $('#phone-otp').val()))
                })
            })
        </script>
        @vite('resources/js/phone.js')
    </x-slot>
</x-staff-layout>
