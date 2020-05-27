jQuery(document).ready(function(){

	$('.date-time').bootstrapMaterialDatePicker({ 
		format : 'YYYY-MM-DD HH:mm:00', 
		lang : 'es', 
		weekStart : 1, 
		cancelText : 'Cancel' 
	});

	$('.date-only').bootstrapMaterialDatePicker({ 
		format : 'YYYY-MM-DD', 
		time : false,
		lang : 'es', 
		weekStart : 1, 
		cancelText : 'Cancel' 
	});
});