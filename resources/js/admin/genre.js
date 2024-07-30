import '../image.js';

let tabButton = $('button[role="tab"]');
tabButton.first().toggleClass('active border-blue-500 border-none font-bold text-gray-500 text-blue-600 hover:text-blue-600 focus:outline-none focus:text-blue-600');

window.addEventListener('load', function () {
    tabButton.each(function () {
        $(this).on('click', function () {
            let buttonActive = $('button[role="tab"].active')
            buttonActive.toggleClass('active font-bold border-blue-500 border-none text-gray-500 text-blue-600 hover:text-blue-600 focus:outline-none focus:text-blue-600')
            $(this).toggleClass('active font-bold border-blue-500 border-none text-gray-500 text-blue-600 hover:text-blue-600 focus:outline-none focus:text-blue-600')

            $.ajax({
                url: $(this).data('href') ,
                type: 'GET',
                success: function (response) {
                    $('#list-genre').html(response.view);
                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON.message);
                }
            })
        })
    })

    tabButton.filter('.active').trigger('click');

    $(document).on('click', 'button[data-hs-overlay="#modal-add"]', function () {
        let categoryId = $(this).data('id');
        window.HSStaticMethods.autoInit();
        HSOverlay.open('#modal-add');
    })

    $(document).on('submit', '#add-category', function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        axios.post(window.appConfig.urls.store, formData)
            .then(response => {
                toastr.success(response.data.success);
                setTimeout(function () {
                    window.location.reload();
                }, 1000)
            })
            .catch(error => {
                let errors = error.response.data.errors;
                let firstErrorKey = Object.keys(errors)[0];
                let firstErrorMessage = errors[firstErrorKey][0];
                toastr.error(firstErrorMessage)
            })
    })

    $(document).on('click', 'button[data-hs-overlay="#modal-update"][data-id]', function () {
        let categoryId = $(this).data('id');
        let url = window.appConfig.urls.edit.replace(':category', categoryId)
        window.HSStaticMethods.autoInit();

        axios.get(url)
            .then(response => {
                $('#content-form').html(response.data.view);
                HSOverlay.open('#modal-update');
            })
            .catch(error => {
                console.log(error);
            })
    })

    $(document).on('submit', '#update-category', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let url = window.appConfig.urls.update.replace(':category', formData.get('id'));

        axios.post(url, formData)
            .then(response => {
                toastr.success(response.data.success);
                setTimeout(function () {
                    window.location.reload();
                }, 1000)
            })
            .catch(error => {
                let errors = error.response.data.errors;
                let firstErrorKey = Object.keys(errors)[0];
                let firstErrorMessage = errors[firstErrorKey][0];
                toastr.error(firstErrorMessage)
            })
    })
})
