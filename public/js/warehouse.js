jQuery(document).ready(function(){

	$('#amount_sell').focusout(function(){
		var price = parseFloat($('#price_sell').val()),
			amount = parseFloat($('#amount_sell').val());

		if( $("#amount_real").val() == '') $("#amount_real").val(amount);

		//$('#total').val(price * amount);
	})
});