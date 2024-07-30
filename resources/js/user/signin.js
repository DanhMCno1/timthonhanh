function submitFormSignIn() {
    var message = document.getElementById('message_signin');
    var formData = {
        _token: $('input[name="_token"]').val(),
        phone_signin: $('#phone_signin').val(),
        password_signin: $('#password_signin').val(),
    };

    $.ajax({
        url: 'signin',
        method: 'POST',
        data: formData,
        success: function (result) {
            message.textContent = 'Đăng nhập thành công!';
            message.className = 'alert alert-success';
            message.style.display = 'block';
            setTimeout(() => {
                window.location.assign("/");
            }, 1000);
        },
        error: function (result) {
            let errors = result.responseJSON.errors;
            message.textContent = 'Thông tin tài khoản hoặc mật khẩu không chính xác, vui lòng thử lại';
            message.className = 'alert alert-danger';
            message.style.display = 'block';
            // Ẩn thông báo lỗi sau 3 giây
            setTimeout(() => {
                message.style.display = 'none';
            }, 3000);
            if (errors) {
                if (errors.phone_signin) {
                    $('#error-phone_signin').text(errors.phone_signin[0]);
                }
                if (errors.password_signin) {
                    $('#error-password_signin').text(errors.password_signin[0]);
                }
            }
        }
    });
}

window.submitFormSignIn = submitFormSignIn;
