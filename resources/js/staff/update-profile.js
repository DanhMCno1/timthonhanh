import '../phone.js';
import '../image.js';

$(document).ready(function () {
    window.addEventListener('load', () => {
        let el = window.HSSelect.getInstance('#categories');
        let workLists = JSON.parse(window.appConfig.values.workLists);
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

                $('div[data-hs-select-dropdown]').children().each(function () {
                    let dataValue = $(this).data('value');
                    if (workLists.includes(dataValue)) {
                        $(this).click();
                    }
                })
            }
        })

        $(document).on('click', 'div[data-remove]', function() {
            $('input[name=work_lists]').val(JSON.stringify(el.selectedItems))
        });

        el.on('change', (val) => {
            $('input[name=work_lists]').val(JSON.stringify(val));
        });
    });

    $('#update-profile').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: window.appConfig.urls.updateProfile,
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

})

let elementAppend = $('#hs-wrapper-select-for-copy');
let workAreas = JSON.parse(window.appConfig.values.workAreas)

loadArea(
    $('select[name="province_id"]'),
    $('select[name="district_id"]'),
    $('select[name="ward_id"]'),
    window.appConfig.values.provinceId,
    window.appConfig.values.districtId,
    window.appConfig.values.wardId
)

loadProvince($('select[data-value="province"][data-id="-1"]'));
workAreas.forEach(function(workArea) {
    let dataCount = copyArea();
    loadArea(
        $(`select[name="province_ids[]"][data-id=${dataCount}]`),
        $(`select[name="district_ids[]"][data-id=${dataCount}]`),
        $(`select[name="ward_ids[]"][data-id=${dataCount}]`),
        workArea.province_id,
        workArea.district_id,
        workArea.ward_id
    )
});

function loadArea(provinceSelect, districtSelect, wardSelect, provinceId, districtId, wardId) {
    loadProvince(provinceSelect, provinceId);
    loadDistrict(districtSelect, provinceId, districtId);
    loadWard(wardSelect, districtId, wardId);
}

function loadProvince(element, provinceId = null) {
    $.ajax({
        url: window.appConfig.urls.getProvinces,
        type: 'GET',
        success: function (data) {
            $.each(data, function (id, name) {
                $(element).append($('<option>', {
                    value: id,
                    text: name
                }));
            });
            if (provinceId) {
                $(element).val(provinceId);
            }
        }
    })
}

function loadDistrict(element, provinceId, districtId = null) {
    let selectWard = $(element).next();
    resetSelect($(element));
    resetSelect($(selectWard));
    $(element).prop('disabled', false);
    let url = window.appConfig.urls.getDistricts.replace(':province', provinceId);
    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            $.each(data, function (id, name) {
                $(element).append($('<option>', {
                    value: id,
                    text: name
                }));
            });
            if (districtId) {
                $(element).val(districtId);
            }
        }
    });
}

function loadWard(element, districtId, wardId = null) {
    const isHasDataValue = $(element).data('value') !== undefined;
    resetSelect($(element));
    $(element).prop('disabled', false);
    let url = window.appConfig.urls.getWards.replace(':district', districtId);
    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            if (isHasDataValue) {
                $(element).append('<option value="0" selected>Chọn tất cả</option>');
            }
            $.each(data, function (id, name) {
                $(element).append($('<option>', {
                    value: id,
                    text: name
                }));
            });
            if (wardId) {
                $(element).val(wardId);
            }
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

function copyArea() {
    let dataCount = parseInt(elementAppend.attr('data-id'));
    let elementCopy = $('#hs-content-select-for-copy').clone();
    elementCopy.attr('data-id', dataCount);
    elementAppend.attr('data-id', dataCount + 1);
    elementCopy.toggleClass('hidden grid');
    elementCopy.find('select').each(function () {
        $(this).attr('data-id', dataCount);
        if ($(this).data('value') !== 'province') {
            resetSelect($(this));
        }
    })
    elementCopy.appendTo(elementAppend);
    return dataCount;
}

function deleteArea(element) {
    let parentCopy = $(element).parent('#hs-content-select-for-copy')
    parentCopy.nextAll().each(function () {
        $(this).attr('data-id', $(this).attr('data-id') - 1);
    })
    elementAppend.attr('data-id', elementAppend.attr('data-id') - 1);
    parentCopy.remove();
}

window.loadDistrict = loadDistrict;
window.loadWard = loadWard;
window.deleteArea = deleteArea;

