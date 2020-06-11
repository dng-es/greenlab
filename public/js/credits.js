jQuery(document).ready(function(){

    var page_credits = 1;
    
    loadCredits();

    function loadCredits(){
        if ($("#credits" ).length > 0){
            $(".loading_credits" ).show()
            var e = $("#credits" )
                url = e.data('pourl') + "?page=" + page_credits
            e.html('').load( url , function() {
                $(".loading_credits" ).hide()
            });
        }
    } 

    //paginador
    $(document).on('click', '#credits-paginator a',function(event)
    {
        event.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var myurl = $(this).attr('href');
        page_credits = $(this).attr('href').split('page=')[1];

        loadCredits();
    });   

    $('#creditModal').on('hidden.bs.modal', function (e) {
        resetMessages();
        //$('#member_id').val(0);
        $('#credit').val('');
        $('#credit_notes').val('');
    })

    function resetform(){
        resetMessages()
    }

    function resetMessages(){
        $('#credit-message').removeClass('alert-danger alert-success').hide()
        $( ".invalid-feedback" ).remove();
        $.each( $('.form-control') , function( key, value ) {
            $(this).removeClass('is-invalid')
        });
    }

    $('#new_credit').submit(function(e){
        e.preventDefault();

        resetMessages();

        var data_post = $(this).serialize();

        if (parseInt($('#member_id').val()) != 0 && parseFloat($('#credit').val()) != 0){
            //new credit
            $.ajax({
                url: $('#new_credit').prop('action'),
                type:'POST',
                data: data_post,
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        $('#credit-message').addClass('alert-success').html(data.success).show(); 

                        var ini = parseFloat($('#credit_total').html()),
                            total = ini +parseFloat($('#credit').val());
                        $('#credit_total').countTo({
                            from: ini,
                            to: parseFloat(total),
                            speed: 700,
                            decimals: 2,
                            separator: '.'
                        });

                        $('#creditModal').modal('hide');

                        loadCredits();
                    }else{
                        printErrorMsg(data.error);
                    }
                },
                error: function(data){
                     printErrorMsg(data.responseJSON.errors);
                }
            });
        }
    });

    function printErrorMsg (errors) {
        $.each( errors , function( key, value ) {
            $('#' + key).addClass('is-invalid')
            $('#' + key).after('<div class="invalid-feedback" role="alert"><strong>' + value + '</strong></div>')
        });
    }
});