import '../phone.js';
import '../image.js'

$(document).ready(function () {
    window.addEventListener('load', () => {
        const el = HSSelect.getInstance('#categories');
        $.ajax({
            url: window.appConfig.urls.getCategories,
            type: 'GET',
            success: function (data) {
                $.each(data, function (id, name) {
                    el.addOption(
                        {
                            title: name,
                            val: id,
                        }
                    )
                });
            }
        })

        $(document).on('click', 'div[data-remove]', function() {
            $('input[name=work_lists]').val(JSON.stringify(el.selectedItems))
        });

        el.on('change', (val) => {
            $('input[name=work_lists]').val(JSON.stringify(val));
        });
    });

    function checkConditions() {
        const isInputChanged = $('#phone-otp').val().length > 0;
        const isCheckboxChecked = $('#agree').is(':checked');

        if (isInputChanged && isCheckboxChecked) {
            $('#submit').prop('disabled', false);
        } else {
            $('#submit').prop('disabled', true);
        }
    }

    $('#phone-otp').on('input', function() {
        checkConditions();
    });

    $('#agree').on('click', function() {
        checkConditions();
    });


    $.ajax({
        url: window.appConfig.urls.getProvinces,
        type: 'GET',
        success: function (data) {
            $.each(data, function (id, name) {
                $(`select[data-value="province"]`).append($('<option>', {
                    value: id,
                    text: name
                }));
            });
        }
    })

    function loadDistrict(element) {
        let province = $(element).val();
        let selectDistrict = $(element).parent().parent().next().find('select');
        let selectWard = selectDistrict.parent().parent().next().find('select');
        resetSelect(selectDistrict);
        resetSelect(selectWard);
        selectDistrict.prop('disabled', false);
        let url = window.appConfig.urls.getDistricts.replace(':province', province);
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $.each(data, function (id, name) {
                    selectDistrict.append($('<option>', {
                        value: id,
                        text: name
                    }));
                });
            }
        });
    }

    function loadWard(element) {
        const district = element.value;
        const isHasDataValue = $(element).data('value') !== undefined;
        let selectWard = $(element).parent().parent().next().find('select');
        resetSelect(selectWard);
        let url = window.appConfig.urls.getWards.replace(':district', district);
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                selectWard.prop('disabled', false);
                if (isHasDataValue) {
                    selectWard.append('<option value="0" selected>Chọn tất cả</option>');
                }
                $.each(data, function (id, name) {
                    selectWard.append($('<option>', {
                        value: id,
                        text: name
                    }));
                });
            }
        });
    }

    $('#hs-copy-select-content').click(function () {
        copyArea();
    })

    function resetSelect(element) {
        element.prop('disabled', true);
        element.empty();
        element.append('<option disabled selected>Chọn</option>');
    }

    let elementAppend = $('#hs-wrapper-select-for-copy');
    function copyArea() {
        let dataCount = parseInt(elementAppend.attr('data-id'));
        let elementCopy = $('#hs-content-select-for-copy').clone();
        elementCopy.attr('data-id', dataCount);
        elementAppend.attr('data-id', dataCount + 1);
        elementCopy.find('select').each(function () {
            $(this).attr('data-id', dataCount);
            if ($(this).data('value') !== 'province') {
                resetSelect($(this));
            }
        })
        elementCopy.appendTo(elementAppend);
    }

    function deleteArea(element) {
        let parentCopy = $(element).parent('#hs-content-select-for-copy')
        parentCopy.nextAll().each(function () {
            $(this).attr('data-id', $(this).attr('data-id') - 1);
        })
        elementAppend.attr('data-id', elementAppend.attr('data-id') - 1);
        parentCopy.remove();
    }

    $('#register').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: window.appConfig.urls.signup,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                localStorage.setItem('toastrMessage', response.success);
                localStorage.setItem('toastrType', 'success');
                window.location.href = window.appConfig.urls.staffHome;
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let firstErrorKey = Object.keys(errors)[0];
                let firstErrorMessage = errors[firstErrorKey][0];
                toastr.error(firstErrorMessage)
            }
        });
    })

    window.deleteArea = deleteArea;
    window.loadDistrict = loadDistrict;
    window.loadWard = loadWard;
});

