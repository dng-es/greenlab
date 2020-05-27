 $(function () {
	$('#cp1').colorpicker();


	$('#fontcolor').change(function(){
		previewBg();
	})

	$('#fontsize').change(function(){
		previewBg();
	})

	function previewBg(){
		$(".preview-title").css({'color' : $('#fontcolor').val(), 'font-size' : (parseInt($('#fontsize').val()) + 10) + 'px'});
		$(".preview").css({'color' : $('#fontcolor').val(), 'font-size' : $('#fontsize').val() + 'px'});
	}

});