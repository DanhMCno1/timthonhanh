<x-user-layout>
    <x-slot name="header">
        Trang cá nhân
    </x-slot>

    <div class="py-5 px-7 border rounded-t-md min-h-[75vh] mt-3 bg-white shadow rounded">
        <div class="py-3 px-3 ">
            <h3 class="font-medium text-2xl pb-4 flex justify-center">
                Thông tin cá nhân
            </h3>
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="flex flex-col space-y-2">
                    <div>
                        <span class="font-medium">Họ và tên</span>
                        <span class="text-red-600 ms-1">*</span>
                    </div>
                    <input type="text" id="inputName" placeholder="Nguyễn Văn A" name="name"
                           class="py-3 px-4 border w-full border-gray-300 rounded-lg focus:border-primary-user focus:ring-0 focus:outline-primary-user"
                           value="{{ old('name') ??  $user->name }}"
                    >
                    @error('name')
                    <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col space-y-2">
                    <div>
                        <span class="font-medium">
                            Số điện thoại
                        </span>
                        <span class="text-red-600 ms-1">*</span>
                    </div>
                    <div class="flex">
                        <input type="text" value="{{ old('phone') ?? $user->phone }}" inputmode="numeric" id="inputPhone"
                               name="phone"
                               class="p-1 px-4 block w-full border-gray-300 shadow-sm rounded-s-lg focus:border-primary-user focus:ring-0 focus:outline-primary-user disabled:opacity-50 disabled:pointer-events-none"
                               placeholder="Số điện thoại">
                        <button type="submit" id="btnSendOTP"
                                class="p-1 px-4 inline-flex justify-center items-center gap-x-2 min-w-[90px]  min-h-[50px] text-sm font-semibold rounded-e-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                        >
                            Gửi OTP
                        </button>
                    </div>
                    @error('phone')
                        <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div id="inputOTP" class="flex flex-col space-y-2 hidden">
                    <div>
                        <span class="font-medium">OTP</span>
                        <span class="text-red-600 ms-1">*</span>
                    </div>
                    <input type="text" placeholder="OTP" name="phone_otp"
                           class="py-3 px-4 border w-full border-gray-300 rounded-lg focus:border-primary-user focus:ring-0 focus:outline-primary-user"
                    >
                    @error('phone_otp')
                        <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col space-y-2">
                    <div>
                        <span class="font-medium">
                            Tỉnh/Thành phố
                        </span>
                        <span class="required text-red-600 ms-1">*</span>
                    </div>
                    <div class="flex flex-col">
                        <select id="province_select"
                                class="address_info py-3 px-4 border w-full border-gray-300 rounded-lg focus:border-primary-user focus:ring-0 focus:outline-primary-user"
                                name="province_id">
                            <option>Chọn</option>
                        </select>
                    </div>
                    @error('province_id')
                        <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col space-y-2">
                    <div>
                        <span class="font-medium">
                            Quận/Huyện
                        </span>
                        <span class="required text-red-600 ms-1">*</span>
                    </div>
                    <div class="flex flex-col">
                        <select id="district_select"
                                class="address_info py-3 px-4 border w-full border-gray-300 rounded-lg focus:border-primary-user focus:ring-0 focus:outline-primary-user"
                                name="district_id">
                            <option>Chọn</option>
                        </select>
                    </div>
                    @error('district_id')
                        <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col space-y-2">
                    <div>
                        <span class="font-medium">
                            Xã/Phường
                        </span>
                        <span class="required text-red-600 ms-1">*</span>
                    </div>
                    <div class="flex flex-col">
                        <select id="ward_select"
                                class="address_info py-3 px-4 border w-full border-gray-300 rounded-lg focus:border-primary-user focus:ring-0 focus:outline-primary-user"
                                name="ward_id">
                            <option>Chọn</option>
                        </select>
                    </div>
                    @error('ward_id')
                        <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col space-y-2">
                    <div>
                        <span class="font-medium">Thôn/Xóm/Số nhà</span>
                        <span class="required text-red-600 ms-1">*</span>
                    </div>
                    <div class="flex flex-col">
                        <input id="hamlet" value="{{ $user->hamlet }}"
                               class="py-3 px-4 border w-full border-gray-300 rounded-lg focus:border-primary-user focus:ring-0 focus:outline-primary-user"
                               type="text" placeholder="Thôn/Xóm/Số nhà"
                               name="hamlet">
                    </div>
                    @error('hamlet')
                        <span class="text-red-700 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="py-3 bg-primary-user rounded-lg">
                    <button type="button" class="text-white text-base w-full font-semibold" data-hs-overlay="#hs-vertically-centered-modal">Cập nhật</button>
                </div>
                <div id="hs-vertically-centered-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
                    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                        <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                            <div class="flex justify-end items-center py-3 px-4">
                                <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-vertically-centered-modal">
                                    <span class="sr-only">Close</span>
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4 overflow-y-auto flex items-center justify-center">
                                <p class="text-center text-base">Bạn có chắc chắn muốn thay đổi thông tin ?</p>
                            </div>
                            <div class="flex justify-center items-center gap-x-2 py-3 px-4">
                                <button type="submit" id="updateProfile" class="py-3 px-5 inline-flex items-center gap-x-2 text-base font-semibold rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"  data-hs-overlay="#hs-vertically-centered-modal">
                                    Cập nhật
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="script">
        <script type="module">
            $(document).ready(function () {
                function loadProvinces() {
                    $.ajax({
                        url: '/provinces',
                        method: 'GET',
                        success: function (provinces) {
                            $('#province_select').empty();
                            $('#province_select').append('<option value="">Chọn</option>');

                            $.each(provinces, function (index, province) {
                                $('#province_select').append('<option value="' + index + '">' + province + '</option>');
                            });

                            $('#province_select').val({{ $user->province_id }});

                            loadDistricts($('#province_select').val());
                        }
                    });
                }

                function loadDistricts(provinceId) {
                    $.ajax({
                        url: `provinces/${provinceId}/districts`,
                        method: 'GET',
                        success: function (districts) {
                            $('#district_select').empty();
                            $('#district_select').append('<option value="">Chọn</option>');

                            $.each(districts, function (index, district) {
                                $('#district_select').append('<option value="' + index + '">' + district + '</option>');
                            });

                            $('#district_select').val({{ $user->district_id }});

                            loadWards($('#district_select').val());
                        }
                    });
                }

                function loadWards(districtId) {
                    $.ajax({
                        url: `districts/${districtId}/wards`,
                        method: 'GET',
                        success: function (wards) {
                            $('#ward_select').empty();
                            $('#ward_select').append('<option value="">Chọn</option>');

                            $.each(wards, function (index, ward) {
                                $('#ward_select').append('<option value="' + index + '">' + ward + '</option>');
                            });

                            // Set giá trị của select xã/phường từ user
                            $('#ward_select').val({{ $user->ward_id }});
                        }
                    });
                }

                loadProvinces();

                $('#province_select').change(function () {
                    var provinceId = $(this).val();
                    loadDistricts(provinceId);
                });

                $('#district_select').change(function () {
                    var districtId = $(this).val();
                    loadWards(districtId);
                });

                $('#btnSendOTP').on('click', function(e) {
                    e.preventDefault();
                    let phone = $("#inputPhone").val();
                    $.ajax({
                        url: "{{ route('otp.send') }}",
                        type: "POST",
                        data: {
                            phone: phone,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            toastr.success(response.message);
                            $('#inputOTP').removeClass('hidden');
                        },
                        error: function (xhr, status, error) {
                            toastr.error(xhr.responseJSON.message);
                        },
                    });
                })
            });
        </script>
    </x-slot>
</x-user-layout>
