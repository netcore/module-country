'use strict';

$(() => {
	let $table = $('#countries-datatable');
	$table.dataTable({
		columns: [
			{sortable: true},
			{sortable: true},
			{sortable: true},
			{sortable: false, searchable: false, width: 100, className: 'text-center'},
			{sortable: false, searchable: false, width: 200, className: 'text-right'},
		]
	});

	$table.on('change', 'input.is-active', e => {
		let input = $(e.target);
		let id = input.data('id');

		$.post(`/admin/country/countries/${id}/toggle`).done(({message}) => {
			$.growl.success({message});
		}).fail(() => {
			input.prop('checked', !input.is(':checked'));
		});
	});
});