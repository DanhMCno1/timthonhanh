<x-user-layout>
    <x-slot name="header">
        Đăng ký
    </x-slot>

    {{--Thẻ hiển thị thông báo đăng ký thành công/thất bại--}}
    <div id="message" class="hidden p-4 rounded-3xl text-center"><i class="fa-regular fa-circle-xmark"></i></div>
    {{--Form signup--}}
    <div class=" py-5 px-7 border rounded-t-md min-h-[75vh] mt-3 bg-white shadow rounded">
        <h3 class="text-3xl font-semibold text-center mb-2">Đăng ký</h3>
        <p class="text-center mb-6 font-semibold">
            Phía thợ đăng ký
            <a href="#" class="underline text-blue-600 font-semibold">ở đây</a>
        </p>
        <div>
            <span class=" text-[16px] font-medium flex justify-center">Thông tin tài khoản</span>
        </div>
        <form id="form-1">
            @csrf
            <div class="mx-6 max-w-[540px]">
                <div class="form-group my-4">
                    <label for="phone" class="font-semibold mb-2 text-sm">Số điện thoại <span
                            class="text-rose-500 font-bold">*</span></label>
                    <input id="phone" class=" w-full rounded-xl p-[13px]" type="text" placeholder="Số điện thoại"
                        name="phone">
                    <div class="label-text mt-1 text-sm">※ Số điện thoại được sử dụng để thợ có thể liên lạc với bạn
                    </div>
                    <span class="text-rose-600 font-semibold" id="error-phone"></span>
                </div>


                <div class="form-group my-6">
                    <label for="password" class="font-semibold mb-2 mt-8 text-sm">Mật khẩu <span
                            class="text-rose-500 font-bold">*</span></label>
                    <input id="password" class="w-full rounded-xl p-[14px]" type="password"
                        placeholder="Mật khẩu (trên 8 ký tự)" name="password">
                    <span class="text-rose-600 font-semibold" id="error-password"></span>
                </div>

                <div class="form-group my-6">
                    <label for="confirm_password" class="font-semibold mb-2 mt-8 text-sm">Xác nhận mật khẩu <span
                            class="text-rose-500 font-bold">*</span></label>
                    <input id="confirm_password" class="w-full rounded-xl p-[14px]" type="password"
                        placeholder="Xác nhận mật khẩu" name="confirm_password">
                    <span class="text-rose-600 font-semibold" id="error-confirm-password"></span>
                </div>

                <span class="mt-10 text-[16px] font-semibold flex justify-center">Thông tin cá nhân</span>

                <div class="form-group my-6">
                    <label for="fullname" class="font-semibold mb-2 mt-8 text-sm">Họ và tên <span
                            class="text-rose-500 font-bold">*</span></label>
                    <input id="fullname" class="w-full rounded-xl p-[14px]" type="text" placeholder="Họ và tên"
                        name="fullname">
                    <span class="text-rose-600 font-semibold" id="error-fullname"></span>
                </div>

                <div class="form-group my-6">
                    <label for="province" class="font-semibold mb-2 mt-8 text-sm">Tỉnh/Thành phố <span
                            class="text-rose-500 font-bold">*</span></label>
                    <select id="province_select" class="address_info w-full focus:ring-blue-700 rounded-xl p-3.5"
                            name="province_id">
                        <option>Chọn</option>
                    </select>
                    <span class="text-rose-600 font-semibold" id="error-province_id"></span>
                </div>

                <div class="form-group my-6">
                    <label for="district" class="font-semibold mb-2 mt-8 text-sm">Quận/Huyện <span
                            class="text-rose-500 font-bold">*</span></label>
                    <select id="district_select" class="address_info w-full focus:ring-blue-700 rounded-xl p-3.5"
                            name="district_id">
                        <option>Chọn</option>
                    </select>
                    <span class="text-rose-600 font-semibold" id="error-district_id"></span>
                </div>

                <div class="form-group my-6">
                    <label for="ward" class="font-semibold mb-2 mt-8 text-sm">Phường/Xã <span
                            class="text-rose-500 font-bold">*</span></label>
                    <select id="ward_select" class="address_info w-full focus:ring-blue-700 rounded-xl p-3.5"
                            name="ward_id">
                        <option>Chọn</option>
                    </select>
                    <span class="text-rose-600 font-semibold" id="error-ward_id"></span>
                </div>
                <div class="form-group my-6">
                    <label for="hamlet" class="font-semibold mb-2 mt-8 text-sm">Thôn/Xóm/Số nhà <span
                            class="text-rose-500 font-bold">*</span></label>
                    <input id="address" class="w-full rounded-xl p-[14px]" type="text" placeholder="Thôn/Xóm/Số nhà"
                        name="hamlet">
                    <div class="text-rose-600 font-semibold" id="error-address"></div>
                </div>

                <div class=" mt-10 flex text-center items-center">
                    <input id="agree-terms" type="checkbox" class="w-[24px] h-[24px] rounded-lg focus:ring-0 ">
                    <p class="ml-2 text-xs">Đăng ký đồng nghĩa với việc bạn đã đồng ý với <a href=""
                                                                                            class="underline text-sm">Điều
                            khoản sử dụng</a></p>
                </div>
                <div class=" mt-16 mb-6 text-center">
                    <button type="button" onclick="submitFormSignUp()"
                            class="py-3 px-12 bg-blue-700 rounded-3xl text-white font-semibold">Đăng ký
                    </button>
                </div>
            </div>
        </form>
    </div>

    <x-slot name="script">
        @vite('resources/js/user/signup.js')
        <script type="module">
            $(document).ready(function () {
                window.appConfig = {
                    csrfToken: '{{ csrf_token() }}'
                }
            })
        </script>
    </x-slot>
</x-user-layout>
