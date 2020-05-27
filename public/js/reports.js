jQuery(document).ready(function(){

	$('#stats-refresh').click(function(e){
		e.preventDefault();

		var month = $('#month').val(),
			year = $('#year').val(),
			order = $('#order').val(),
			limit = $('#limit').val(),
			url = $(this).data('url') + '/?month=' + month + '&year=' + year + '&order=' + order + '&limit=' + limit;

		location.href = url;
	});
});