<x-user-layout>
    <x-slot name="header">
        Đăng nhập
    </x-slot>

    {{--Thẻ hiển thị thông báo đăng ký thành công/thất bại--}}
    <div id="message_signin" class="hidden p-4 rounded-3xl text-center"></div>
    {{--Form signin--}}
    <div class="py-5 px-7 border rounded-t-md min-h-[75vh] mt-3 bg-white shadow rounded">
        <h3 class="text-3xl font-semibold text-center mb-2">Đăng nhập</h3>
        <p class="text-center mb-6">Phía thợ đăng nhập <a href="#" class="underline text-blue-600 font-semibold">ở
                đây</a></p>
        <div class="mx-4" id="alert-container">
            <form id="form-2">
                @csrf
                <div class="form-group my-4">
                    <label for="phone_signin" class="font-semibold mb-2 text-sm">Số điện thoại</label>
                    <input id="phone_signin" class=" w-full rounded-xl p-[13px]" type="text" placeholder="Số điện thoại"
                           name="phone_signin">
                    <span class="text-rose-600 font-semibold" id="error-phone_signin"></span>
                </div>

                <div class="form-group my-10">
                    <label for="password_signin" class="font-semibold mb-2 mt-8 text-sm">Mật khẩu</label>
                    <input id="password_signin" class="w-full rounded-xl p-[14px]" type="password"
                           placeholder="Mật khẩu (trên 8 ký tự)" name="password_signin">
                    <span class="text-rose-600 font-semibold" id="error-password_signin"></span>
                </div>

                <div class=" mt-10 flex text-center items-center">
                    <input id="remember" type="checkbox" class="w-[24px] h-[24px] rounded-lg focus:ring-0 ">
                    <p class="ml-2 font-semibold">Ghi nhớ trạng thái đăng nhập</p>
                </div>

                <div class=" mt-16 mb-6 text-center">
                    <button type="button" onclick="submitFormSignIn()"
                            class="py-3 px-12 bg-blue-700 rounded-3xl text-white font-semibold">Đăng nhập
                    </button>
                </div>
            </form>
            <a href="{{ route('forget-password') }}" class="underline text-blue-500 font-semibold">Quên mật khẩu?</a>
            <p class="my-4">Nếu bạn chưa có tài khoản <a href="{{ route('signup') }}"
                                                         class="underline text-blue-500 font-semibold">ở đây</a>
            </p>
        </div>
    </div>
    <x-slot name="script">
        @vite('resources/js/user/signin.js')
    </x-slot>
</x-user-layout>
