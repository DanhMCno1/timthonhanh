function changeCategory(url = null) {
    $.ajax({
        url: url ,
        type: 'GET',
        // data: { category_id: categoryId },
        success: function (response) {
            $('#request-list').html(response.view);
        },
        error: function (xhr) {
            toastr.error(xhr.responseJSON.message);
        }
    })
}

$(document).ready(function () {
    $('button[role="tab"].active').trigger('click');
})


$('button[role="tab"]').each(function () {
    $(this).on('click', function () {
        let buttonActive = $('button[role="tab"].active')
        buttonActive.find('span').toggleClass('bg-primary bg-dark-blue')
        buttonActive.toggleClass('active text-primary border-primary hover:bg-orange-700 text-black border-black hover:bg-black')

        $(this).find('span').toggleClass('bg-primary bg-dark-blue')
        $(this).toggleClass('active text-primary border-primary hover:bg-orange-700 text-black border-black hover:bg-black')

        changeCategory($(this).data('href'));
    })
})

$(document).on('click', '#paginate a', function (e) {
    e.preventDefault();

    changeCategory(this.href);
});


