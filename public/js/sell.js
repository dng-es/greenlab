jQuery(document).ready(function(){
    var elemAlert = $("#alert-sell")
        credit = false;

	$(".numeric").numeric();

	$('.amount').keyup(function() {
		var id = $(this).data('id'),
			amount = parseFloat($(this).val())
			price = parseFloat($(this).data('price')),
			total_price = (amount * price).toFixed(2);

		$('#money' + id).val(total_price);
		recalculateTotals();
	});

	$('.money').keyup(function() {
		var id = $(this).data('id'),
			money = parseFloat($(this).val())
			price = parseFloat($(this).data('price')),
			amount = (money / price).toFixed(2);

		$('#prod' + id).val(amount);
		recalculateTotals();

	});

	function recalculateTotals(){
		var total_amount = 0,
			total_price = 0;

		$('.amount').each(function(){
			total_amount += parseFloat($(this).val());
		})

		$('.money').each(function(){
			total_price += parseFloat($(this).val());
		})

		//$('#total_amount').html(parseFloat(total_amount).toFixed(2));
		$('#total_price').html(parseFloat(total_price).toFixed(2));
	}

	//reset
    $(document).on('click', '#sell_reset',function(e){
        e.preventDefault();
        var elem = $(this);

        Swal.fire({
            title: "¿Estas seguro?",
            text: "Seguro que deseas reiniciar la venta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar"
        }).then((result) => {
            if (result.value) {
                resetForm();      
            }
        })
    });

    function resetForm(){
    	$('.amount').val(0);
		$('.money').val(0);
        credit = false;
		recalculateTotals();
    }

    //para mostrar alertas en los controles de los formularios en peticiones ajax
    function printErrorMsg (errors) {
        $.each( errors , function( key, value ) {
            $('#' + key).addClass('is-invalid')
            $('#' + key).after('<div class="invalid-feedback" role="alert"><strong>' + value + '</strong></div>')
        });
    }

    $('#credit_finish').click(function() {
        credit = true;
        $('#sell_form').submit();

    });

    //send
    $(document).on('submit', '#sell_form',function(e){
        e.preventDefault();
        elemAlert.hide();
        var elem = $(this),
        	url_form = elem.prop('acticion');

        Swal.fire({
            title: "¿Estas seguro?",
            text: "Seguro que deseas finalizar la venta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar"
        }).then((result) => {
            if (result.value) {
                $.ajax({
		            url: url_form,
		            type:'POST',
		            data: elem.serialize() + "&credit=" + credit,
		            success: function(data) {
		                if($.isEmptyObject(data.error)){
                            $("#alert-msg").html(data.success);
                            elemAlert.show(function(){
                                //elemAlert.fadeOut(6000);
                            });
                            var ini = parseFloat($('#total_month').html());
                            $('#total_month').countTo({
                                from: ini,
                                to: parseFloat(data.total_month),
                                speed: 700,
                                decimals: 2,
                                separator: ','
                            });

                            var credit = parseFloat($('#credit_total').html());
                            $('#credit_total').countTo({
                                from: credit,
                                to: parseFloat(data.credit),
                                speed: 700,
                                decimals: 2,
                                separator: ','
                            });

		                    //$('#total_month').html(data.total_month);
		                    resetForm();
		                }else{
		                    printErrorMsg(data.error);
		                }
		            },
		            error: function(data){
		                $("#savePetition").html('Modificar petición').attr('disabled', false)
		                printErrorMsg(data.responseJSON.errors);
		            }
		        });
            }
        });
        
    });
});