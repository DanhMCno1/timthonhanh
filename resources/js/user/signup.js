$(document).ready(function () {
    // Load danh sách tỉnh
    $.ajax({
        url: '/provinces',
        method: 'GET',
        success: function (provinces) {
            $.each(provinces, function (index, province) {
                $('#province_select').append('<option value="' + index + '">' + province + '</option>');
            });
        }
    });

    // Load danh sách huyện khi chọn tỉnh
    $('#province_select').change(function () {
        var provinceId = $(this).val();

        $.ajax({
            url: `provinces/${provinceId}/districts`,
            method: 'GET',
            success: function (districts) {
                $('#district_select').empty();
                $('#district_select').append('<option value="">Chọn</option>');

                $.each(districts, function (index, district) {
                    $('#district_select').append('<option value="' + index + '">' + district + '</option>');
                });
            }
        });
    });

    // Load danh sách xã/phường khi chọn huyện
    $('#district_select').change(function () {
        var districtId = $(this).val();

        $.ajax({
            url: `districts/${districtId}/wards`,
            method: 'GET',
            success: function (wards) {
                $('#ward_select').empty();
                $('#ward_select').append('<option value="">Chọn</option>');

                $.each(wards, function (index, ward) {
                    $('#ward_select').append('<option value="' + index + '">' + ward + '</option>');
                });
            }
        });
    });

    // Submit form
    function submitFormSignUp() {
        // Đồng ý điều khoản
        var checkbox = document.getElementById('agree-terms');
        var messageDiv = document.getElementById('message');
        if (!checkbox.checked) {
            alert('Vui lòng đồng ý với Điều khoản sử dụng trước khi đăng ký.');
            return;
        }
        const isValidate = onValidate();
        if (isValidate) {
            const data = {
                _token: window.appConfig.csrfToken,
                fullname: $('#fullname').val(),
                phone: $('#phone').val(),
                password: $('#password').val(),
                province_id: $('#province_select').val(),
                district_id: $('#district_select').val(),
                ward_id: $('#ward_select').val(),
                hamlet: $('#address').val(),
                confirm_password: $('#confirm_password').val()

            }
            //handle
            $.ajax({
                url: '/signup',
                method: 'POST',
                data: data,
                success: function (result) {
                    // alert('Bạn đã đăng ký tài khoản thành công !');
                    messageDiv.textContent = 'Bạn đã đăng ký tài khoản thành công!';
                    messageDiv.className = 'alert alert-success';
                    messageDiv.style.display = 'block';
                    setTimeout(() => {
                        window.location.assign("signin");
                    }, 3000);
                },
                error: function (result) {
                    let errors = result.responseJSON.errors;
                    messageDiv.textContent = 'Đăng ký thất bại, vui lòng thử lại';
                    messageDiv.className = 'alert alert-danger';
                    messageDiv.style.display = 'block';
                    // Ẩn thông báo lỗi sau 3 giây
                    setTimeout(() => {
                        messageDiv.style.display = 'none';
                    }, 3000);
                    if (errors) {
                        if (errors.fullname) {
                            $('#error-fullname').text(errors.fullname[0]);
                        }
                        if (errors.phone) {
                            $('#error-phone').text(errors.phone[0]);
                        }
                        if (errors.password) {
                            $('#error-password').text(errors.password[0]);
                        }
                        if (errors.confirm_password) {
                            $('#error-confirm-password').text(errors.confirm_password[0]);
                        }
                        if (errors.district_id) {
                            $('#error-district_id').text(errors.district_id[0]);
                        }
                        if (errors.province_id) {
                            $('#error-province_id').text(errors.province_id[0]);
                        }
                        if (errors.ward_id) {
                            $('#error-ward_id').text(errors.ward_id[0]);
                        }
                        if (errors.hamlet) {
                            $('#error-address').text(errors.hamlet[0]);
                        }
                    }
                }
            })
        }
    }

    // Validate form
    function onValidate() {
        return true;
        let isValidated = true;
        let message = '';
        return isValidated;
    }

    window.submitFormSignUp = submitFormSignUp;
});
