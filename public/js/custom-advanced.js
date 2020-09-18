/** CustomADVANCED - Table, Filters, RangeSlider, Datepicker... **/

function operateFormatter(value, row, index) {
    return [
        '<a class="view" href="javascript:void(0)" title="View">',
        '<i class="fa fa-eye"></i>',
        '</a>  ',
        '<button type="button" class="edit btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button>',
        '</a>  ',
        '<a class="remove" href="javascript:void(0)" title="Remove">',
        '<i class="fa fa-trash"></i>',
        '</a>'
    ].join('')
}

function editModal(row) {

    let $modal = $("#edit-modal").modal();
    let $checkbox = $("input[name='categories[]']");

    $modal.trigger("reset");

    $.each(row, function (key, value) {
        if (key !== 'client_info' && key !== 'client_detail' && key !== 'state' && key !== 'uuid' && key !== 'tags' && key !== 'categories') {
            $("label[for='" + key + "']").text(key.replace(/_/g, ' '))

            $modal.find('#' + key).val(value)
        } else if (key === 'client_info' && key !== 'client_detail') {
            $.each(row.client_info, function (key, value) {

                if (key !== 'client_id') {
                    $("label[for='" + key + "']").text(key.replace(/_/g, ' '))

                    $modal.find('#' + key).val(value)

                }
            })
        } else if (key !== 'client_info' && key === 'client_detail') {
            $.each(row.client_detail, function (key, value) {
                if (key !== 'client_id' && key !== 'pay_in' && key !== 'win') {
                    $("label[for='" + key + "']").text(key.replace(/_/g, ' '))

                    $modal.find('#' + key).val(value)
                }
            });
        } else if (key === 'categories') {
            $checkbox.each(function () {
                $(this).prop('checked', false);
            });
            if (row.categories.length > 0) {
                $.each(row.categories, function (key, value) {
                    let id = value.name;
                    $checkbox.each(function () {
                        if (id === $(this).val()) {
                            $(this).prop('checked', true);
                        }
                    });
                });
            } else {
                $checkbox.each(function () {
                    $(this).prop('checked', false);
                });
            }
        } else if (key === 'tags') {

            if (key !== 'pivot') {

                window.app.setSelectedTags(row.tags);
            }
        }
    });

}

window.operateEvents = {
    'click .view': function (e, value, row, index) {
        viewModal(row);
    },

    'click .edit': function (e, value, row, index) {
        editModal(row);
    },
    'click .remove': function (e, value, row, index) {
        /* Note: this remove event only remove the data from 
        the table/view temporary until the next reload */
        $table.bootstrapTable('remove', {
            field: 'id',
            values: [row.id]
        })
    }
};
let $update = $('#update-data');
$update.on('click', function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function (key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }

    let client_id = $('#id').val();
    let myForm = $('#edit-client');
    let gender = $('select[name=gender]').val();
    $.ajax({
        type: "POST",
        url: "clients/" + client_id + "",
        data: myForm.serialize(),
        beforeSend: function () {
            $update.toggleClass('btn-primary').attr("disabled", "disabled");
            $update.html('<div class="spinner-grow" role="status">\n' +
                '  <span class="sr-only">Loading...</span>\n' +
                '</div>');
        },
        success: function (data) {
            setTimeout(function () {
                $update.toggleClass('btn-primary');
                $update.html('Save changes').removeAttr("disabled");
                $('#edit-modal').modal('toggle');
                toastr["success"]('Data has been updated.', "Success");
                $table.bootstrapTable('refreshOptions', {})
                $.ajax({
                    type: "POST",
                    url: "categoryTag",
                    contentType: "text/json; charset=utf-8",
                    dataType: "json",
                    success: function (res) {
                        window.app.setExistingTag(res);
                        let categoriesHtml = '';
                        $.each(res.existing_categories, function (index, value) {
                            let id = value.name;
                            let val = value.name.replace(/_/g, " ").toUpperCase();
                            categoriesHtml +=
                                '<div class="custom-control custom-checkbox my-1 mr-sm-2">\n' +
                                '<input type="checkbox" class="custom-control-input" id="' + id + '" name="categories[]" value="' + id + '">\n' +
                                '<label class="custom-control-label" for="' + id + '">' + val + '</label>\n' +
                                '</div>'

                        });
                        $('#allCategories').html(categoriesHtml);
                    }
                });
            }, 500);
        },
        error: function (data) {
            if (data.status === 422) {
                $update.toggleClass('btn-primary');
                $update.html('Save changes').removeAttr("disabled");
                let errors = data.responseJSON.errors;

                printErrorMsg(errors);
            }
        }
    });

});

$(document).ready(function () {
    $('#createCategory').click(function () {
        if ($('#addCategory').val() && $('#addCategory').val().replace(/\s/g, "_").toLowerCase() !== $('#allCategories :checkbox').val()) {
            let value = $('#addCategory').val();
            let id = value.replace(/\s/g, "_").toLowerCase();
            $('#allCategories').append(
                '<div class="custom-control custom-checkbox my-1 mr-sm-2">\n' +
                '<input type="checkbox" class="custom-control-input" id="' + id + '" name="categories[]" value="' + id + '">\n' +
                '<label class="custom-control-label" for="' + id + '">' + value + '</label>\n' +
                '<i class="remove-category fas fa-trash-alt"></i>\n' +
                '</div>'
            )
        }
        $('.remove-category').click(function () {
            $(this).parent().remove();
        });
    });
    $('#edit-modal').on('hidden.bs.modal', function () {
        // alert('close')
        $("#edit-client").trigger("reset");
        $("#errors").css('display', 'none');
        // $(':input').val('');
    })
});
