//Validate phone input
const inputPhone = $("#inputPhone");
const btnSendOTP = $("#btnSendOTP");
const inputPhoneErr = $("#inputPhoneErr");
const phoneRegex = /^0(3[2-9]|5[2-9]|7[0-9]|8[1-9]|9[0-9])[0-9]{7}$/;
inputPhone.change(function () {
    if (inputPhone.val() !== "") {
        if (!phoneRegex.test(inputPhone.val())) {
            inputPhoneErr.removeClass("hidden");
            inputPhoneErr.html("Số điện thoại không đúng định dạng");
            btnSendOTP.prop("disabled", true);
        } else {
            inputPhoneErr.addClass("hidden");
            btnSendOTP.prop("disabled", false);
        }
    } else {
        inputPhoneErr.removeClass("hidden");
        inputPhoneErr.html("Số điện thoại không được để trống");
        btnSendOTP.prop("disabled", true);
    }
});

//Validate pasword
const inputNewPassword = $("#newPassword");
const confirmPassword = $("#confirmPassword");
const inputPWErr = $("#inputPWErr");
const inputConfirmPWErr = $("#inputConfirmPWErr");
const btnResetPW = $("#btnResetPW");
inputNewPassword.on("input", function () {
    if (inputNewPassword.val() !== "") {
        if (inputNewPassword.val().length < 8) {
            inputPWErr.removeClass("hidden");
            inputPWErr.html("Mật khẩu phải dài tối thiểu 8 ký tự");
        } else {
            inputPWErr.addClass("hidden");
            confirmPassword.prop("disabled", false);
        }
    } else {
        inputPWErr.removeClass("hidden");
        inputPWErr.html("Mật khẩu là bắt buộc");
    }
});
confirmPassword.on("input", function () {
    if (confirmPassword.val() !== "") {
        if (inputNewPassword.val() !== confirmPassword.val()) {
            inputConfirmPWErr.removeClass("hidden");
            inputConfirmPWErr.html("Mật khẩu không khớp");
        } else {
            inputConfirmPWErr.addClass("hidden");
            btnResetPW.prop("disabled", false);
        }
    } else {
        inputConfirmPWErr.removeClass("hidden");
        inputConfirmPWErr.html("Xác nhận mật khẩu là bắt buộc");
        btnResetPW.prop("disabled", true);
    }
});
