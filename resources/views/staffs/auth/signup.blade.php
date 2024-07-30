<x-staff-layout>
    <x-slot name="header">
        Đăng ký
    </x-slot>

    <div class="py-5 px-7 border rounded-t-md min-h-[80vh] mt-3 bg-white shadow rounded">
        <h3 class="text-center font-medium text-3xl pb-5">Đăng ký</h3>
        <div class="font-medium text-[16px] pb-5 text-center">Phía người tìm thợ đăng ký
            <a href="/auth/signup" class="text-primary underline">ở đây</a>
        </div>

        <form id="register" enctype="multipart/form-data">
            @csrf
            <div class="pb-7">
                <div class="relative flex my-3 items-center">
                    <div class="flex-grow border-b-2 border-[#2B3440]"></div>
                    <span class="flex-shrink text-[16px] mx-4 font-medium">Thông tin tài khoản</span>
                    <div class="flex-grow border-b-2 border-[#2B3440]"></div>
                </div>

                <!-- Phone -->
                <div class="mt-8">
                    <label for="phone" class="block text-sm mb-2">Số điện thoại<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="text" name="phone" id="phone" class="p-4 block w-full border-gray-300 rounded-s-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Số điện thoại">
                        <button id="send-phone-otp" disabled type="button" class="w-28 rounded-e-lg bg-primary text-white hover:bg-hover-primary disabled:opacity-30 disabled:text-black disabled:bg-gray-500 disabled:pointer-events-none">
                            Gửi OTP
                        </button>
                    </div>
                    <div id="phone-error" class="hidden text-sm text-[#dc2626] mt-2" role="alert"></div>
                </div>

                <div id="otp-input" class="mt-7 hidden">
                    <label for="phone-otp" class="block text-sm mb-2">OTP<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="number" id="phone-otp" name="phone_otp" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary">
                    </div>
                </div>

                <div class="mt-7">
                    <label for="email" class="block text-sm mb-2">Email<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="email" id="email" name="email" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Email">
                    </div>
                </div>

                <div class="mt-7">
                    <label for="password" class="block text-sm mb-2">Mật khẩu<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="password" id="password" name="password" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Mật khẩu (trên 8 ký tự)">
                    </div>
                </div>

                <div class="mt-7">
                    <label for="password-confirmation" class="block text-sm mb-2">Xác nhận mật khẩu<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="password" id="password-confirmation" name="password_confirmation" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Xác nhận mật khẩu">
                    </div>
                </div>
            </div>

            <div class="pb-7">
                <div class="relative flex my-3 items-center">
                    <div class="flex-grow border-b-2 border-[#2B3440]"></div>
                    <span class="flex-shrink text-[16px] mx-4 font-medium">Thông tin cá nhân</span>
                    <div class="flex-grow border-b-2 border-[#2B3440]"></div>
                </div>

                <div class="mt-7">
                    <label for="name" class="block text-sm mb-2">Họ và tên<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="text" id="name" name="name" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Nguyễn Văn A">
                    </div>
                </div>

                <div class="mt-7">
                    <label for="birthday" class="block text-sm mb-2">Ngày sinh<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="date" id="birthday" name="birthday" class="p-4 block w-full border-gray-300 rounded-lg focus:border-primary focus:ring-0 focus:outline-primary">
                    </div>
                </div>

                <div class="mt-7">
                    <label for="gender" class="block text-sm">Giới tính<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex gap-x-6 rounded-lg h-12">
                        <div class="flex items-center">
                            <input type="radio" name="gender" value="0" class="shrink-0 border-primary rounded-full text-primary focus:ring-0 ring-offset-0 focus:ring-offset-0 focus:ring-s w-5 h-5" id="male">
                            <label for="male" class="ms-2">Nam</label>
                        </div>

                        <div class="flex items-center">
                            <input type="radio" name="gender" value="1" class="shrink-0 border-primary rounded-full text-primary focus:ring-0 ring-offset-0 focus:ring-offset-0 focus:ring-s w-5 h-5" id="female">
                            <label for="female" class="ms-2">Nữ</label>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="block text-sm mb-2">Tỉnh/Thành phố<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <select data-value="province" onchange="loadDistrict(this)" name="province_id" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-primary focus:ring-0 focus:outline-primary">
                            <option disabled selected>Chọn</option>
                        </select>
                    </div>
                </div>

                <div class="mt-7">
                    <label class="block text-sm mb-2">Quận/Huyện<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <select onchange="loadWard(this)" disabled name="district_id" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-primary focus:ring-0 focus:outline-primary disabled:opacity-50 disabled:bg-gray-200 disabled:pointer-events-none">
                            <option disabled selected>Chọn</option>
                        </select>
                    </div>
                </div>

                <div class="mt-7">
                    <label class="block text-sm mb-2">Xã/Phường<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <select disabled name="ward_id" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-primary focus:ring-0 focus:outline-primary disabled:opacity-50 disabled:bg-gray-200 disabled:pointer-events-none">
                            <option disabled selected>Chọn</option>s
                        </select>
                    </div>
                </div>

                <div class="mt-7">
                    <label for="hamlet" class="block text-sm mb-2">Thôn/Xóm<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="text" id="hamlet" name="hamlet" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" placeholder="Thôn/Xóm">
                    </div>
                </div>
            </div>

            <div>
                <div class="relative flex my-3 items-center">
                    <div class="flex-grow border-b-2 border-[#2B3440]"></div>
                    <span class="flex-shrink text-[16px] mx-4 font-medium">Công việc</span>
                    <div class="flex-grow border-b-2 border-[#2B3440]"></div>
                </div>

                <div class="mt-7">
                    <label for="work-lists" class="block text-sm mb-2">Danh mục công việc<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg">
                        <select multiple id="categories" data-hs-select='{
                        "placeholder": "Chọn",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500",
                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-blue-300 rounded-lg focus:outline-none focus:bg-gray-100",
                        "mode": "tags",
                        "wrapperClasses": "relative ps-0.5 pe-9 min-h-[46px] flex items-center flex-wrap text-nowrap w-full border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500",
                        "tagsItemTemplate": "<div class=\"flex flex-nowrap items-center relative z-9 bg-blue-700 rounded-lg px-2 py-1 m-1\"><div class=\"whitespace-nowrap text-white\" data-title></div><div class=\"inline-flex justify-center items-center size-5 ms-2 text-white cursor-pointer\" data-remove><svg class=\"flex-shrink-0 size-3\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg></div></div>",
                        "tagsInputClasses": "py-3 px-2 order-1 border-none cursor-default focus:ring-0 text-sm outline-none",
                        "optionTemplate": "<div class=\"flex items-center\"><div class=\"text-sm text-gray-800\" data-title></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"flex-shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"flex-shrink-0 size-3.5 text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                        }'>
                        </select>
                        <input type="hidden" name="work_lists">
                    </div>
                </div>

                <div class="mt-7">
                    <label for="work_areas" class="block text-sm mb-2">Khu vực làm việc<span class="text-red-600 ms-1">*</span></label>
                    <div id="hs-wrapper-select-for-copy" data-id="1" class="space-y-3">
                        <div id="hs-content-select-for-copy" data-id="0" class="grid grid-cols-[1fr,1fr,1fr,20px] gap-1 sm:gap-4 items-center">
                            <div>
                                <div>
                                    <select data-value="province" data-id="0" onchange="loadDistrict(this)" name="province_ids[]" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-primary focus:ring-0 focus:outline-primary">
                                        <option disabled selected>Chọn</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <select data-value="district" data-id="0" onchange="loadWard(this)" disabled name="district_ids[]" class="py-3 px-4 pe-9 block w-full border-gray-100 rounded-lg text-sm focus:border-primary focus:ring-0 focus:outline-primary disabled:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none">
                                        <option disabled selected>Chọn</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <select data-value="ward" data-id="0" disabled name="ward_ids[]" class="py-3 px-4 pe-9 block w-full border-gray-100 rounded-lg text-sm focus:border-primary focus:ring-0 focus:outline-primary disabled:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none">
                                        <option disabled selected>Chọn</option>
                                    </select>
                                </div>
                            </div>
                            <div data-id="0" onclick="deleteArea(this)" class="w-[20px] h-[20px] cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center pt-1 rounded text-center label-text mt-4">
                        <button type="button" id="hs-copy-select-content" class="py-1.5 px-2 text-sm items-center gap-x-1 text-primary">
                            <i class="fa-regular fa-plus"></i> Thêm khu vực
                        </button>
                    </div>
                </div>

                <div class="mt-7">
                    <label for="description" class="block text-sm mb-2">Miêu tả bản thân<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg">
                        <textarea id="description" name="description" class="py-3 px-4 block w-full border-gray-200 rounded-lg placeholder-gray-400 focus:border-primary focus:ring-0 focus:outline-primary" rows="3" placeholder="Tôi có kinh nghiệm 10 năm điện tử điện lạnh, là một người cẩn thận, tỉ mỉ trong công việc..."></textarea>

                    </div>
                </div>

                <div class="mt-7">
                    <label for="image" class="block text-sm mb-2">Ảnh profile<span class="text-red-600 ms-1">*</span></label>
                    <label for="image-input" class="cursor-pointer">
                        <input type="file" name="image" id="image-input" class="hidden">
                        <div class="border-gray-300 col rounded-full overflow-hidden w-[120px] h-[120px] flex justify-center items-center">
                            <i data-name="icon" class="text-6xl fa-solid fa-cloud-arrow-up"></i>
                            <img class="w-full h-full object-cover rounded-full hidden" src="" alt="">
                        </div>
                    </label>
                </div>

                <div class="flex mt-5">
                    <input type="checkbox" class="shrink-0 mt-0.5 border-primary text-primary rounded focus:border-primary focus:ring-0 focus:outline-none focus:ring-offset-0 ring-offset-0" id="agree">
                    <label for="agree" class="text-sm ms-3">
                        Đăng ký đồng nghĩa với việc bạn đã đồng ý với
                        <a href="/dieu-khoan-su-dung" class="underline label-text">Điều Khoản Sử Dụng</a>
                    </label>
                </div>
            </div>
            <div class="flex justify-center mt-7">
                <button id="submit" type="submit" disabled class="py-3 px-4 w-36 mb-5 inline-flex justify-center font-bold items-center gap-x-2 rounded-full border border-transparent bg-primary text-white hover:bg-hover-primary disabled:opacity-30 disabled:text-black disabled:bg-gray-500 disabled:pointer-events-none">
                    Đăng ký
                </button>
            </div>
        </form>
    </div>

    <x-slot name="script">
        <script type="module">
            $(document).ready(function () {
                window.appConfig = {
                    urls: {
                        getProvinces: '{{ route('provinces.index') }}',
                        getDistricts: '{{ route("provinces.districts.index", ":province") }}',
                        getWards: '{{ route("districts.wards.index", ":district") }}',
                        getCategories: '{{ route('categories.index') }}',
                        sendOtpUrl: '{{ route('otp.send') }}',
                        signup: '{{ route('staff.signup.store') }}',
                        staffHome: '{{ route('staff.home') }}'
                    },
                    values: {
                        role: '',
                    },
                    csrfToken: '{{ csrf_token() }}'
                };
            })
        </script>
        @vite('resources/js/staff/signup.js')
    </x-slot>
</x-staff-layout>
