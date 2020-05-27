jQuery(document).ready(function(){

	$('#amount_sell').focusout(function(){
		var price = parseFloat($('#price_sell').val()),
			amount = parseFloat($('#amount_sell').val());

		$('#total').val(price * amount);
	})
});