'use strict';

$(() => {
    $('#cities-datatable').dataTable({
        columns: [
            {sortable: true},
            {sortable: true},
            {sortable: true},
            {sortable: false, searchable: false, width: 200, className: 'text-right'},
        ]
    });
});