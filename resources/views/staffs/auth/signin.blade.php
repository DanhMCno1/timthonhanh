<x-staff-layout>
    <x-slot name="header">
        Đăng nhập
    </x-slot>

    <div class="py-5 px-7 border rounded-t-md min-h-[75vh] mt-3 bg-white shadow rounded">
        <h3 class="text-center font-medium text-3xl">Đăng nhập</h3>
        <div class="text-[16px] my-1 text-center">Phía người tìm thợ đăng nhập
            <a href="/auth/signin" class="text-primary underline">ở đây</a>
        </div>

        <form class="pt-7 pb-6" action="{{ route('staff.signin.store') }}" method="post">
            @csrf

            <div>
                <label for="phone" class="block font-medium text-sm mb-2">Số điện thoại</label>
                <div class="flex rounded-lg h-12">
                    <input type="text" id="phone" value="{{ old('phone') }}" name="phone" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Số điện thoại" required>
                </div>
                @error('phone')
                <div class="text-sm text-[#dc2626] mt-2" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mt-6">
                <label for="password" class="block font-medium text-sm mb-2">Mật khẩu</label>
                <div class="flex rounded-lg h-12">
                    <input type="password" id="password" name="password" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" required placeholder="Mật khẩu (trên 8 ký tự)">
                </div>
                @error('password')
                <div class="text-sm text-[#dc2626] mt-2" role="alert">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="flex mt-6">
                <input {{ old('remember') ? 'checked' : '' }} name="remember" type="checkbox" class="shrink-0 w-6 h-6 border-primary text-primary rounded-lg focus:border-primary focus:ring-0 focus:outline-none focus:ring-offset-0 ring-offset-0" id="agree">
                <label for="agree" class="font-medium ms-2">
                    Ghi nhớ trạng thái đăng nhập
                </label>
            </div>

            <div class="flex justify-center mt-7">
                <button id="submit" type="submit" disabled class="mt-5 py-3 px-7 w-44 font-bold inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-primary text-white hover:bg-hover-primary disabled:opacity-50 disabled:text-black disabled:bg-gray-400 duration-100 disabled:pointer-events-none">
                    Đăng nhập
                </button>
            </div>
        </form>
        <div>
            <a href="/staff/auth/forgot-password" class="text-primary underline">Quên mật khẩu ?</a>
            <div class="mt-3">
                <span> Nếu bạn chưa có tài khoản, đăng ký
                    <a href="{{ route('staff.signup.create') }}" class="text-primary underline">ở đây</a>
                </span>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="module">
            $('input').on('input', function () {
                let phone = $('input[name="phone"]').val()
                let password = $('input[name="password"]').val()

                if (phone !== '' && password !== '') {
                    $('#submit').prop('disabled', false);
                } else {
                    $('#submit').prop('disabled', true);
                }
            })
        </script>
    </x-slot>
</x-staff-layout>
