<x-staff-layout>
    <x-slot name="header">
        Chỉnh sửa thông tin
    </x-slot>

    <form id="update-profile" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $staff->id }}">
        <div class="border rounded-t-md mt-3 bg-white shadow rounded relative">
            <div class="py-5 px-3">
                <h3 class="text-center font-medium text-2xl pb-5">Thông tin cá nhân</h3>

                <div>
                    <input type="file" name="image" id="image-input" class="hidden">
                    <div class="flex flex-col items-center justify-center">
                        <div class="col border border-gray-300 rounded-full overflow-hidden w-[120px] h-[120px] flex justify-center items-center">
                            <img id="preview-image" class="w-full h-full object-cover" src="{{ Storage::url($staff->image->path) }}" alt="">
                        </div>
                        <label for="image-input" class="cursor-pointer mt-2 col text-[#ea580c]">Thay đổi ảnh đại diện</label>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="name" class="inline-block font-medium mb-2">Họ và tên<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="text" id="name" name="name" value="{{ $staff->name }}" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c]" placeholder="Nguyễn Văn A">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="phone" class="inline-block font-medium mb-2">Số điện thoại<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="text" name="phone" id="phone" value="{{ $staff->phone }}" class="p-4 block w-full border-gray-300 rounded-s-lg placeholder-gray-400 focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c]" placeholder="Số điện thoại">
                        <button id="send-phone-otp" disabled type="button" class="w-28 rounded-e-lg bg-[#ea580c] text-white hover:bg-hover-primary disabled:opacity-30 disabled:text-black disabled:bg-gray-500 disabled:pointer-events-none">
                            Gửi OTP
                        </button>
                    </div>
                    <div id="phone-error" class="hidden text-sm text-[#dc2626] mt-2" role="alert"></div>
                </div>

                <div id="otp-input" class="mt-7 hidden">
                    <label for="phone-otp" class="inline-block font-medium mb-2">OTP<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="number" id="phone-otp" name="phone_otp" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c]">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="email" class="inline-block font-medium mb-2">Email<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="email" id="email" name="email" value="{{ $staff->email }}" class="p-4 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c]" placeholder="Email">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="birthday" class="inline-block font-medium mb-2">Ngày sinh<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg h-12">
                        <input type="date" id="birthday" value="{{ $staff->birthday }}" name="birthday" class="p-4 block w-full border-gray-300 rounded-lg focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c]">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="gender" class="inline-block font-medium">Giới tính<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex gap-x-3 rounded-lg h-10">
                        <div class="flex items-center">
                            <input {{ $staff->gender === 0 ? 'checked' : '' }} type="radio" name="gender" value="0" class="shrink-0 border-[#EA580C] rounded-full text-[#EA580C] focus:ring-0 ring-offset-0 focus:ring-offset-0 focus:ring-s w-6 h-6 checked:bg-none checked:shadow-radio-mark" id="male">
                            <label for="male" class="ms-1">Nam</label>
                        </div>

                        <div class="flex items-center">
                            <input {{ $staff->gender === 1 ? 'checked' : '' }} type="radio" name="gender" value="1" class="shrink-0 border-[#EA580C] rounded-full text-[#EA580C] focus:ring-0 ring-offset-0 focus:ring-offset-0 focus:ring-s w-6 h-6 checked:bg-none checked:shadow-radio-mark" id="female">
                            <label for="female" class="ms-1">Nữ</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="inline-block font-medium mb-2">Địa chỉ<span class="text-red-600 ms-1">*</span></label>
                    <div class="grid grid-cols-[1fr,1fr,1fr] gap-1">
                        <select onchange="loadDistrict(this.nextElementSibling, this.value)" name="province_id" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c]">
                            <option disabled selected>Chọn</option>
                        </select>
                        <select onchange="loadWard(this.nextElementSibling, this.value)" disabled name="district_id" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c] disabled:opacity-50 disabled:bg-gray-200 disabled:pointer-events-none">
                            <option disabled selected>Chọn</option>
                        </select>
                        <select disabled name="ward_id" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c] disabled:opacity-50 disabled:bg-gray-200 disabled:pointer-events-none">
                            <option disabled selected>Chọn</option>
                        </select>
                    </div>
                    <input type="text" id="hamlet" name="hamlet" value="{{ $staff->hamlet }}" class="py-3 px-4 mt-2 block w-full border-gray-300 rounded-lg placeholder-gray-400 focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c]" placeholder="Thôn/Xóm">
                </div>

                <div class="mt-6">
                    <label for="description" class="inline-block font-medium mb-2">Giới thiệu bản thân<span class="text-red-600 ms-1">*</span></label>
                    <div class="flex rounded-lg">
                        <textarea id="description" name="description" class="py-3 px-4 block w-full border-gray-200 rounded-lg placeholder-gray-400 focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c]" rows="3" placeholder="Tôi có kinh nghiệm 10 năm điện tử điện lạnh, là một người cẩn thận, tỉ mỉ trong công việc...">{{ $staff->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="border rounded-t-md mt-3 bg-white shadow rounded relative">
            <div class="py-5 px-3">
                <h3 class="text-center font-medium text-2xl pb-5">Thông tin công việc</h3>

                <div class="">
                    <label for="work-lists" class="inline-block font-medium mb-2">Danh mục công việc<span class="text-red-600 ms-1">*</span></label>
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
                    <label for="work_areas" class="inline-block font-medium mb-2">Khu vực làm việc<span class="text-red-600 ms-1">*</span></label>
                    <div id="hs-wrapper-select-for-copy" data-id="0" class="space-y-3">
                        <div id="hs-content-select-for-copy" data-id="-1" class="hidden grid-cols-[1fr,1fr,1fr,20px] gap-1 sm:gap-4 items-center">
                            <select data-value="province" data-id="-1" onchange="loadDistrict(this.nextElementSibling, this.value)" name="province_ids[]" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c]">
                                <option disabled selected>Chọn</option>
                            </select>
                            <select data-value="district" data-id="-1" onchange="loadWard(this.nextElementSibling, this.value)" disabled name="district_ids[]" class="py-3 px-4 pe-9 block w-full border-gray-100 rounded-lg text-sm focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c] disabled:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none">
                                <option disabled selected>Chọn</option>
                            </select>
                            <select data-value="ward" data-id="-1" disabled name="ward_ids[]" class="py-3 px-4 pe-9 block w-full border-gray-100 rounded-lg text-sm focus:border-[#ea580c] focus:ring-0 focus:outline-[#ea580c] disabled:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none">
                                <option disabled selected>Chọn</option>
                            </select>
                            <div data-id="-1" onclick="deleteArea(this)" class="w-[20px] h-[20px] cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center pt-1 rounded text-center label-text mt-4">
                        <button type="button" id="hs-copy-select-content" class="py-1.5 px-2 text-sm items-center gap-x-1 text-[#ea580c]">
                            <i class="fa-regular fa-plus"></i> Thêm khu vực
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="border rounded-t-md mt-3 bg-white shadow rounded relative">
            <div class="py-5 px-3">
                <div class="flex justify-center">
                    <button id="submit" type="submit" class="py-3 px-4 w-full inline-flex justify-center font-bold items-center gap-x-2 rounded-lg border border-transparent bg-[#ea580c] text-white hover:bg-hover-primary">
                        Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </form>
    @php
        $work_lists = [];
        foreach ($staff->categories as $category) {
            $work_lists[] = $category->pivot->category_id;
        }
        $work_lists = json_encode($work_lists);
    @endphp
    <x-slot name="script">
        <script type="module">
            window.appConfig = {
                urls: {
                    getProvinces: '{{ route('provinces.index') }}',
                    getDistricts: '{{ route("provinces.districts.index", ":province") }}',
                    getWards: '{{ route("districts.wards.index", ":district") }}',
                    getCategories: '{{ route('categories.index') }}',
                    sendOtpUrl: '{{ route('otp.send') }}',
                    signup: '{{ route('staff.signup.store') }}',
                    staffHome: '{{ route('staff.home') }}',
                    updateProfile: '{{ route('staff.profile.update') }}'
                },
                values: {
                    provinceId: '{{ $staff->province_id }}',
                    districtId: '{{ $staff->district_id }}',
                    wardId: '{{ $staff->ward_id }}',
                    workLists: '{!! $work_lists !!}',
                    workAreas: '{!! json_encode($staff->areas)  !!}'
                },
                csrfToken: '{{ csrf_token() }}'
            };
        </script>
        @vite('resources/js/staff/update-profile.js')
    </x-slot>
</x-staff-layout>
