/** Custom - Table, Filters, RangeSlider, Datepicker... **/

let $table = $('#location');
let $remove = $('#remove');
let selections = [];

let $button = $('#filter');

function queryParams(params) {
    let message = '';
    let $filterMessage = $('#filter_message');

    $filterMessage.empty();

    params.datefilter = $('input[name="datefilter"]').val();
    if (params.datefilter) {
        message = "Дата на регистрирање: " + params.datefilter;
        $filterMessage.append('<span id="date-filter" type="button" class="btn badge badge-pill badge-danger mr-1">' + message + '&nbsp<i class="fas fa-times-circle"></i></span>');
    }
    if ($('#pay-in').prop('disabled') === false) {
        params.pay_in = $('input[name="pay_in"]').val();
        if (params.pay_in) {
            message = "Уплата: " + params.pay_in;
            $filterMessage.append('<span id="clear-pay-in-filter" type="button" class="btn badge badge-pill badge-danger mr-1">' + message + '&nbsp<i class="fas fa-times-circle"></i></span>');
        }
    }

    if ($('#win').prop('disabled') === false) {
        params.win = $('input[name="win"]').val();
        if (params.win) {
            message = "Добивка: " + params.win;
            $filterMessage.append('<span id="clear-win-filter" type="button" class="btn badge badge-pill badge-danger mr-1">' + message + '&nbsp<i class="fas fa-times-circle"></i></span>');
        }
    }
    if ($('input[name="valid_phone_number"]').is(":checked")) {
        params.is_valid_phone_number = 1;
        if (params.is_valid_phone_number) {
            message = "Валиден тел. број";
            $filterMessage.append('<span id="valid-phone" type="button" class="btn badge badge-pill badge-danger mr-1">' + message + '&nbsp<i class="fas fa-times-circle"></i></span>');
        }
    }
    if ($('input[name="today-birthday"]').is(":checked")) {
        params.filter_by_birth_date = true;
        if (params.filter_by_birth_date) {
            message = "Денешни родендени";
            $filterMessage.append('<span id="birthday" type="button" class="btn badge badge-pill badge-danger mr-1">' + message + '&nbsp<i class="fas fa-times-circle"></i></span>');
        }
    }
    params.categories = '';
    if (!jQuery.isEmptyObject($('select[name="categories[]"]').val())) {
        params.categories = $('select[name="categories[]"]').val();
        if (params.categories) {
            message = "Категории: " + params.categories;
            $filterMessage.append('<span id="clear-categories-filter" type="button" class="btn badge badge-pill badge-danger mr-1">' + message.replace(/_/g, " ") + '&nbsp<i class="fas fa-times-circle"></i></span>');
        }
    }
    params.tags = '';
    if (!jQuery.isEmptyObject($('select[name="tags[]"]').val())) {
        params.tags = $('select[name="tags[]"]').val();
        if (params.tags) {
            message = "Тагови: " + params.tags;
            $filterMessage.append('<span id="clear-tags-filter" type="button" class="btn badge badge-pill badge-danger mr-1">' + message + '&nbsp<i class="fas fa-times-circle"></i></span>');
        }
    }
    params.age = '';
    text = '';
    if (!jQuery.isEmptyObject($('input[name="age_from"]').val() && $('input[name="age_to"]').val())) {
        params.age = $('input[name="age_from"]').val() + ";" + $('input[name="age_to"]').val();
        text = $('input[name="age_from"]').val() + " " + "-" + " " + $('input[name="age_to"]').val();
        if (params.age) {
            message = "Години: " + text;
            $filterMessage.append('<span id="clear-age-filter" type="button" class="btn badge badge-pill badge-danger mr-1">' + message + '&nbsp<i class="fas fa-times-circle"></i></span>');
        }
    }
    params.from_city = '';
    if (!jQuery.isEmptyObject($('select[name="from_city[]"]').val())) {
        params.from_city = $('select[name="from_city[]"]').val();
        if (params.from_city) {
            message = "По град: " + params.from_city;
            $filterMessage.append('<span id="from-city" class="badge badge-pill badge-primary mr-1">' + message + '</span>');
        }
    }
    return params
}

$(document).on('click', '#search', function (e) {
    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '.applyBtn', function (e) {
    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#date-filter', function (e) {
    $("#datefilter").val('');

    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#applyPayInFilter', function (e) {
    $('#pay-in').prop('disabled', false);
    $('#clearPayInFilter').prop('disabled', false);
    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#clearPayInFilter, #clear-pay-in-filter', function (e) {
    $('#pay-in').prop('disabled', true);
    $('#clearPayInFilter').prop('disabled', true);
    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#applyWinFilter', function (e) {
    $('#win').prop('disabled', false);
    $('#clearWinFilter').prop('disabled', false);
    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#clearWinFilter, #clear-win-filter', function (e) {
    $('#win').prop('disabled', true);
    $('#clearWinFilter').prop('disabled', true);
    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#valid_phone_number', function (e) {

    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#today-birthday', function (e) {

    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#valid-phone', function (e) {
    $("#valid_phone_number").prop("checked", false);

    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#birthday', function (e) {
    $("#today-birthday").prop("checked", false);

    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '.selectMultiple ul li', function (e) {
    setTimeout("$('#table').bootstrapTable('refresh')", 1000);
});

$(document).on('click', '.selectMultiple > div a', function (e) {
    setTimeout("$('#table').bootstrapTable('refresh')", 2000);
});

$(function () {
    $("#filter-categories").on("changed.bs.select", function(e) {
        setTimeout("$('#table').bootstrapTable('refresh')", 500);
    });
});

$(function () {
    $("#filter-tags").on("changed.bs.select", function(e) {
        setTimeout("$('#table').bootstrapTable('refresh')", 500);
    });
});

$(document).on('click', '#clear-categories-filter', function (e) {
    $('#filter-categories').val('');
    $('[data-id="filter-categories"]').toggleClass('bs-placeholder');
    $('[data-id="filter-categories"] .filter-option-inner-inner').text('Select Categories');
    $table.bootstrapTable('refreshOptions', {})
});

$(document).on('click', '#clear-tags-filter', function (e) {
    $('#filter-tags').val('');
    $('[data-id="filter-tags"]').toggleClass('bs-placeholder');
    $('[data-id="filter-tags"] .filter-option-inner-inner').text('Select Tags');
    $table.bootstrapTable('refreshOptions', {})
});

$(function () {
    $("#age_from,#age_to").on("keyup change", function(e) {
        $("#age_to").attr("min", +$('#age_from').val() + 1);
        $("#age_from").attr("max", +$('#age_to').val() - 1);
        setTimeout("$('#table').bootstrapTable('refresh')", 1500);
    });
});

$(document).on('click', '#clear-age-filter', function (e) {
    $('#age_from,#age_to').val('');
    $table.bootstrapTable('refreshOptions', {})
});

window.ajaxOptions = {
    beforeSend: function (xhr) {
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
    }
};

function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
        return row.id
    })
}

function responseHandler(res) {
    // $.each(res.data, function (i, row) {
    //     row.state = $.inArray(row.id, selections) !== -1
    // });
    // console.log(res);
    // $.each(res, function (i, row) {
        // console.log(res[i]);
        // return res[i];
    // });
    console.log(res);
    return res;
}

function detailFormatter(index, row) {
    let html = [];
    html.push('<p><b>' + 'Registration Date' + ':</b> ' + row.registration_date + '</p>');
    html.push('<p><b>' + 'Registration Location' + ':</b> ' + row.registered_on_location + '</p>');
    html.push('<p><b>' + 'Code' + ':</b> ' + row.client_detail.code + '</p>');
    html.push('<p><b>' + 'Card Number' + ':</b> ' + row.client_detail.card_number + '</p>');
    html.push('<p><b>' + 'City' + ':</b> ' + row.client_info.city + '</p>');
    html.push('<p><b>' + 'Gender' + ':</b> ' + row.client_info.gender + '</p>');
    html.push('<p><b>' + 'Street Number' + ':</b> ' + row.client_info.street_number + '</p>');
    html.push('<p><b>' + 'Status' + ':</b> ' + row.status + '</p>');

    return html.join('')
}

function totalTextFormatter() {
    return 'Total'
}

function totalNameFormatter(data) {
    return data.length
}

function totalSumFormatter(data) {
    let field = this.field;
    const words = field.split('.');
    return data.map(function (row) {
        // console.log(row[words[0]][words[1]]);
        return +row[words[0]][words[1]]
    }).reduce(function (sum, i) {
        return sum + i
    }, 0) + ' mkd'
}

function viewModal(row) {

    let modal = $("#view-modal").modal();

    $.each(row, function (key, value) {
        if (key !== 'client_info' && key !== 'client_detail' && key !== 'state' && key !== 'uuid' && key !== 'tags' && key !== 'categories') {
            $("label[for='" + key + "']").text(key.replace(/_/g, ' '))

            modal.find('#' + key).text(value)
        } else if (key === 'client_info' && key !== 'client_detail') {
            $.each(row.client_info, function (key, value) {

                if (key !== 'client_id') {
                    if (key === 'is_valid_phone_number') {
                        if (value === 0) {
                            value = 'No'
                        } else {
                            value = 'Yes'
                        }
                    }

                    $("label[for='" + key + "']").text(key.replace(/_/g, ' '))

                    modal.find('#' + key).text(value)

                }
            })
        } else if (key !== 'client_info' && key === 'client_detail') {
            $.each(row.client_detail, function (key, value) {
                if (key !== 'client_id' && key !== 'pay_in' && key !== 'win') {
                    $("label[for='" + key + "']").text(key.replace(/_/g, ' '))

                    modal.find('#' + key).text(value)
                }
            })
        } else if (key === 'categories') {
            let viewCategoriesHtml = '';
            if (row.categories.length > 0) {
                $.each(row.categories, function (key, value) {
                    let id = value.name.replace(/_/g, " ").toUpperCase();
                    viewCategoriesHtml += '<button id="category-badge" class="btn btn-primary m-1">' + id + '&nbsp<i class="fas fa-check-circle"></i>\n' +
                        '</button>'
                });
            }
            $("#categories").html(viewCategoriesHtml);
        } else if (key === 'tags') {
            let viewTagsHtml = '';
            $.each(row.tags, function (key, value) {
                let id = value.value;
                if (key !== 'pivot') {
                    viewTagsHtml += '<span id="tag-badge" class="btn badge badge-pill badge-info m-1">' + id + '&nbsp<i class="fas fa-check-circle"></i></span>'
                }
            });
            $('#tags').html(viewTagsHtml);
        }
    })
}

function initTable(res) {
    $table.bootstrapTable('destroy').bootstrapTable({
        // exportDataType: $(this).val(),
        formatLoadingMessage: function() {
            return '<b>Wait a second</b>\n' +
                '<div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">\n' +
                '  <span class="sr-only">Loading...</span>\n' +
                '</div>' +
                '<div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">\n' +
                '  <span class="sr-only">Loading...</span>\n' +
                '</div>' +
                '<div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">\n' +
                '  <span class="sr-only">Loading...</span>\n' +
                '</div>';
        },
        exportTypes: ['json', /*'xml',*/ /*'png',*/ 'csv', 'txt', /*'sql',*/ 'doc', 'excel', 'xlsx', 'pdf'],
        exportOptions: {
            /*ignoreColumn: ['state'],
            jspdf: {orientation: 'l',
                    unit:'pt',
                    format: 'a4',
                    margins: {left: 20,
                             right: 10,
                             top: 10,
                             bottom: 10}

        },*/
            fileName: function () {
                return 'locations'
            }
        },
        columns: [
            [{
                field: 'state',
                checkbox: true,
                rowspan: 2,
                align: 'center',
                valign: 'middle'
            }, {
                title: 'Location ID',
                field: 'location',
                rowspan: 2,
                align: 'center',
                valign: 'middle',
                sortable: true,
                footerFormatter: totalTextFormatter
            }, {
                field: 'address',
                title: 'Address',
                sortable: true,
                rowspan: 2,
                align: 'center',
                valign: 'middle',
                footerFormatter: totalNameFormatter
            }, {
                title: '2020',
                colspan: 6,
                align: 'center'
            }, {
                title: '2019',
                colspan: 6,
                align: 'center'
            }],
            [{
                field: '2020.payin',
                title: 'payin',
                sortable: true,
                align: 'center'
            }, {
                field: '2020.payout',
                title: 'payout',
                sortable: true,
                align: 'center'
            }, {
                field: '2020.payoutTax',
                title: 'payoutTax',
                align: 'center'
            }, {
                field: '2020.payinCount',
                title: 'payinCount',
                sortable: true,
                align: 'center'
            }, {
                field: '2020.payoutCount',
                title: 'payoutCount',
                sortable: true,
                align: 'center',
                footerFormatter: totalSumFormatter
            }, {
                field: '2020.payoutCount',
                title: 'payoutCount+',
                sortable: true,
                align: 'center',
                footerFormatter: totalSumFormatter
            },{
                field: '2019.payin',
                title: 'payin',
                sortable: true,
                align: 'center'
            }, {
                field: '2019.payout',
                title: 'payout',
                sortable: true,
                align: 'center'
            }, {
                field: '2019.payoutTax',
                title: 'payoutTax',
                align: 'center'
            }, {
                field: '2019.payinCount',
                title: 'payinCount',
                sortable: true,
                align: 'center'
            }, {
                field: '2019.payoutCount',
                title: 'payoutCount',
                sortable: true,
                align: 'center',
                footerFormatter: totalSumFormatter
            }, {
                field: '2019.payoutCount',
                title: 'payoutCount+',
                sortable: true,
                align: 'center',
                footerFormatter: totalSumFormatter
            },

            ]
        ]

    });

    $table.on('check.bs.table uncheck.bs.table ' +
        'check-all.bs.table uncheck-all.bs.table',
        function () {
            $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);

            // save your data, here just save the current page
            selections = getIdSelections()
            // push or splice the selections if you want to save all data selections
        });
    $table.on('all.bs.table', function (e, name, args) {
        console.log(name, args)
    });
    $remove.click(function () {
        let ids = getIdSelections();
        $table.bootstrapTable('remove', {
            field: 'id',
            values: ids
        });
        $remove.prop('disabled', true)
    })
}

$('#toolbar').find('select').change(function () {
    $table.bootstrapTable('refreshOptions', {
        exportDataType: $(this).val(),
    })
});

$(function () {
    initTable()
});

$(function () {
    let $dateFilter = $('input[id="datefilter"]');
    $dateFilter.daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $dateFilter.on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD-MMM-Y') + ' - ' + picker.endDate.format('DD-MMM-Y'));
    });

    $dateFilter.on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
});

$(".js-range-slider").ionRangeSlider({
    skin: "sharp",
    type: "double",
    grid: true,
    min: 0,
    max: 100000,
    from: 0,
    to: 10000,
    step: 10000
});

$('#win').prop('disabled', true);
$('#clearWinFilter').prop('disabled', true);
$('#pay-in').prop('disabled', true);
$('#clearPayInFilter').prop('disabled', true);

$(document).ready(function () {
    $('.show-filters').click(function () {
        $('.filter-panel').slideToggle('slow');
        $('span circle').toggleClass('circle');
        $('span .fltr-line1').toggleClass('x-line1');
        $('span .fltr-line2').toggleClass('x-line2');
    });
});
