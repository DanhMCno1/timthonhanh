$(document).on('change', 'input[type="file"]', function (e) {
    const regex = /\.(jpg|jpeg|png|bmp|gif|svg|webp)$/i;
    const divImage = $(this).next();
    const icon = divImage.find('i[data-name="icon"]');
    const imagePreview = divImage.find('img');
    const file = e.target.files[0];

    if (!file) return;

    if (regex.test(file.name)) {
        const reader = new FileReader();
        reader.onload = function (e) {
            if (!divImage.hasClass('border')) {
                divImage.addClass('border')
            }
            imagePreview.attr('src', e.target.result);
            imagePreview.removeClass('hidden');
            icon.addClass('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        toastr.error('Hãy chọn file ảnh!')
    }
})
