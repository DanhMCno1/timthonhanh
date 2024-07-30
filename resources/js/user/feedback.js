$(document).ready(function() {
    let images = [];

    $('#fileInput').on('change', function(e) {
        var files = e.target.files;
        var totalFiles = files.length;
        var currentImages = $('.preview').find('.uploaded-image').length;

        if (totalFiles + currentImages > 5) {
            toastr.error('Bạn chỉ có thể upload tối đa 5 ảnh.');
            $('#fileInput').val('');
            return;
        }

        for (var i = 0; i < totalFiles; i++) {
            let file = files[i];
            images.push(file);
            let imageIndex = images.length - 1;
            $('.preview').append(`
                <div class="w-full relative aspect-square rounded bg-primary-content/90 flex justify-center uploaded-image" data-index="${imageIndex}">
                    <img class="rounded max-h-full max-w-full" src="${URL.createObjectURL(file)}" alt="Ảnh">
                    <button class="absolute top-0 right-0 delete-image" data-index="${imageIndex}">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </button>
                </div>
            `);
        }
        $('#fileInput').val('');
    });

    $(document).on('click', '.delete-image', function() {
        let index = $(this).data('index');

        if (index !== undefined) {
            images.splice(index, 1);
            $(this).closest('div').remove();
            $('.delete-image').each(function(i) {
                $(this).attr('data-index', i);
                $(this).closest('div').attr('data-index', i);
            });
            images = images.filter((_, idx) => $('.preview').find(`[data-index=${idx}]`).length > 0);
        }
    });

    $('#submit').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        for (var i = 0; i < images.length; i++) {
            formData.append('images[]', images[i]);
        }

        $.ajax({
            url: window.appConfig.urls.postFeedback,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                toastr.success(response.message);
                setTimeout(function() {
                    window.location.href = window.appConfig.urls.requestedStaff;
                }, 1000);
            },
            error: function (xhr, status, error) {
                toastr.error(xhr.responseJSON.message);
            },
        });
    });
});