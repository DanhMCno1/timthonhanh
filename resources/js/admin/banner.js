$(document).ready(function() {
    const preview = $('#preview');
    const regex = /\.(jpg|jpeg|png)$/i;
    const submitBtn = $('#submit');
    let cropper;
    let originalFileName;
    let originalFileType;

    $('#file-input').on('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        if (regex.test(file.name)) {
            if (!submitBtn.hasClass('hidden')) {
                submitBtn.addClass('hidden').prop('disabled', true)
            }
            originalFileName = file.name;
            originalFileType = file.type;

            const reader = new FileReader();
            reader.onload = function (event) {
                if (cropper) cropper.destroy();
                preview.empty();
                const img = $('<img>', {
                    src: event.target.result,
                    id: 'image',
                    class: 'w-full rounded-lg'
                });
                preview.append(img);
                cropper = new Cropper(img[0], {
                    aspectRatio: 1.777778,
                    viewMode: 1
                });
            };
            reader.readAsDataURL(file);
        } else {
            toastr.error('Hãy chọn ảnh có định dạng jpg, jpeg hoặc png!')
        }
    });

    $('#crop-btn').on('click', function(e) {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 522,
                height: 294,
                imageSmoothingQuality: 'high',
                rounded: true,
            });
            canvas.toBlob(function (blob) {
                const dataTransfer = new DataTransfer();
                const croppedFile = new File([blob], originalFileName, { type: originalFileType });
                dataTransfer.items.add(croppedFile);
                $('#file-input')[0].files = dataTransfer.files;
            }, originalFileType);
            const croppedImage = $('<img>', {
                src: canvas.toDataURL()
            });
            preview.empty();
            preview.append(croppedImage);
            submitBtn.removeClass('hidden').prop('disabled', false)
        }
    });
});
