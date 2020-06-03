jQuery(document).ready(function(){

	$('#amount').keyup(function() {
		recalculateTotal();
	});

	$('#price').keyup(function() {
		recalculateTotal();
	});

	function recalculateTotal(){
		var amount = parseFloat($('#amount').val())
            price = parseFloat($('#price').val()),
            total = (amount * price).toFixed(2);

        $('#total').val(total);
	}
});