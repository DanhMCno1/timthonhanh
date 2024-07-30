<x-user-layout>
    <x-slot name="header">
        Liên hệ
    </x-slot>
    {{--Thẻ hiển thị thông báo gửi liên hệ thành công--}}
    <div id="message_contact" class="hidden p-4 rounded-3xl text-center"><i class="fa-regular fa-circle-xmark"></i>
    </div>
    {{--Form contact--}}
    <div class=" py-5 px-7 border rounded-t-md min-h-[75vh] mt-3 bg-white shadow rounded ">
        <h3 class="text-3xl font-semibold text-center mb-2">Liên hệ</h3>
        <form id="form-3">
            @csrf
            <div class="mx-6 max-w-[540px]">
                <div class="form-group my-6">
                    <label for="fullname_contact" class="font-semibold">Họ và tên <span class="text-rose-500 font-bold">*</span></label>
                    <input id="fullname_contact" class="w-full rounded-xl p-[14px]" type="text" placeholder="Họ và tên"
                           name="fullname_contact">
                    <span class="text-rose-600 font-semibold" id="error-fullname_contact"></span>
                </div>
                <div class="form-group my-6">
                    <label for="email_contact" class="font-semibold">Email <span
                            class="text-rose-500 font-bold">*</span></label>
                    <input id="email_contact" class="w-full rounded-xl p-[14px]" type="text" placeholder="Email"
                           name="email_contact">
                    <span class="text-rose-600 font-semibold" id="error-email_contact"></span>
                </div>
                <div class="form-group my-4">
                    <label for="phone_contact" class="font-semibold">Số điện thoại <span
                            class="text-rose-500 font-bold">*</span></label>
                    <input id="phone_contact" class=" w-full rounded-xl p-[13px]" type="text"
                           placeholder="Số điện thoại" name="phone_contact">
                    <span class="text-rose-600 font-semibold" id="error-phone_contact"></span>
                </div>

                <div class="form-group my-6">
                    <label for="description_contact" class="font-semibold">Nội dung liên hệ <span
                            class="text-rose-500 font-bold">*</span></label>
                    <textarea id="description_contact" class="w-full rounded-xl p-[14px] h-[200px]" type="text"
                              placeholder="Mô tả" name="description_contact"></textarea>
                    <div class="text-rose-600 font-semibold" id="error-address_contact"></div>
                </div>

                <div class="mb-6 text-center">
                    <button type="button" onclick="sendContact()"
                            class="w-full py-3 px-12 bg-blue-700 rounded-3xl text-white font-semibold">Gửi
                    </button>
                </div>
            </div>
        </form>
    </div>
    <x-slot name="script">
    <script type="module">
        // Contact form
        function sendContact() {
            var messageDiv = document.getElementById('message_contact');

            const data = {
                _token: "{{ csrf_token() }}",
                fullname: $('#fullname_contact').val(),
                email: $('#email_contact').val(),
                phone: $('#phone_contact').val(),
                description: $('#description_contact').val()
            };

            //handle
            $.ajax({
                url: '/contact',
                method: 'POST',
                data: data,
                success: function (result) {
                    messageDiv.textContent = 'Gửi thông tin liên hệ thành công!';
                    messageDiv.className = 'alert alert-success';
                    messageDiv.style.display = 'block';
                    setTimeout(() => {
                        window.location.assign("");
                    }, 3000);
                },
                error: function (result) {
                    let errors = result.responseJSON.errors;
                    messageDiv.textContent = 'Gửi thông tin liên hệ thất bại, vui lòng thử lại';
                    messageDiv.className = 'alert alert-danger';
                    messageDiv.style.display = 'block';
                    // Ẩn thông báo lỗi sau 3 giây
                    setTimeout(() => {
                        messageDiv.style.display = 'none';
                    }, 3000);
                    if (errors) {
                        if (errors.fullname) {
                            $('#error-fullname_contact').text(errors.fullname[0]);
                        }
                        if (errors.phone) {
                            $('#error-phone_contact').text(errors.phone[0]);
                        }
                        if (errors.email) {
                            $('#error-email_contact').text(errors.email[0]);
                        }
                        if (errors.address) {
                            $('#error-address_contact').text(errors.address[0]);
                        }
                    }
                }
            });
        }

        window.sendContact = sendContact;
    </script>
    </x-slot>
</x-user-layout>

