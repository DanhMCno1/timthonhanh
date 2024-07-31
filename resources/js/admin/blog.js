$(document).ready(function () {
    const container = $('#image-preview-contain');
    const previewImage = $('#image-preview');
    const uploadIcon = $('#icon-upload');
    const imageInput = $('#input-image');
    const regex2 = /\.(jpg|jpeg|png|bmp|gif|svg|webp)$/i;

    container.click(function () {
        imageInput.click();
    });

    imageInput.change(function (event) {
        const input = event.target;

        if (input.files && input.files[0]) {
            const file = input.files[0];

            if (regex2.test(file.name)) {
                const reader2 = new FileReader();

                reader2.onload = function (e) {
                    previewImage.attr('src', e.target.result);
                    previewImage.removeClass('hidden');
                    uploadIcon.addClass('hidden');
                    container.addClass('border border-gray-300 rounded-full');
                }
                reader2.readAsDataURL(input.files[0]);
            } else {
                toastr.error('Hãy chọn file ảnh!');
            }
        } else {
            previewImage.addClass('hidden');
            uploadIcon.removeClass('hidden');
            container.removeClass('border border-gray-300 rounded-full');
        }
    });
})
