/** CustomLITE - Table, Filters, RangeSlider, Datepicker... **/

window.operateEvents = {
    'click .view': function (e, value, row, index) {
        viewModal(row);
    },
};

function operateFormatter(value, row, index) {
    return [
        '<a class="view" href="javascript:void(0)" title="View">',
        '<i class="fa fa-eye"></i>',
        '</a>  ',
    ].join('')
}
