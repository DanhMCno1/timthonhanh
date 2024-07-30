$(document).ready(function () {
    const phoneInput = $('#phone');
    const phoneError = $('#phone-error');
    const buttonSendPhoneOtp = $('#send-phone-otp');
    const phoneRegex = /^0(3[2-9]|5[2-9]|7[0-9]|8[1-9]|9[0-9])[0-9]{7}$/;
    let error = '';

    buttonSendPhoneOtp.prop('disabled', !phoneInput.val())

    phoneInput.on('input', function () {
        if (!phoneInput.val()) {
            error = 'Số điện thoại là bắt buộc.';
        } else {
            if (!phoneRegex.test(phoneInput.val())) {
                error = 'Số điện thoại không đúng định dạng.';
            } else {
                error = '';
            }
        }
        buttonSendPhoneOtp.prop('disabled', error);
    })

    phoneInput.on('change', function () {
        error ? phoneError.removeClass('hidden') : phoneError.addClass('hidden');
        phoneError.html(error);
    })

    buttonSendPhoneOtp.on('click', function () {
        $.ajax({
            url: window.appConfig.urls.sendOtpUrl,
            type: 'POST',
            data: {
                phone: phoneInput.val(),
                role: window.appConfig.values.role,
                _token: window.appConfig.csrfToken
            },
            success: function (response) {
                $('#otp-input').removeClass('hidden');
                toastr.success(response.message);
            },
            error: function (xhr) {
                toastr.error(xhr.responseJSON.message);
            }
        })
    })
})
