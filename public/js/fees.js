
jQuery(document).ready(function(){

    var page_fees = 1;
    
    loadFees();

    function loadFees(){
        if ($("#fees" ).length > 0){
            $(".loading_fees" ).show()
            var e = $("#fees" )
                url = e.data('pourl') + "?page=" + page_fees
            e.html('').load( url , function() {
                $(".loading_fees" ).hide()
            });
        }
    } 

    //paginador
    $(document).on('click', '#fees-paginator a',function(event)
    {
        event.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var myurl = $(this).attr('href');
        page_fees = $(this).attr('href').split('page=')[1];

        loadFees();
    });   

    $('#feesModal').on('hidden.bs.modal', function (e) {
        resetMessages();
        //$('#fees_member_id').val(0);
        $('#fees').val(0);
    })

    $('#feesModal').on('shown.bs.modal', function (e) {
        $('#price').focus();
    })

    function resetform(){
        resetMessages()
    }

    function resetMessages(){
        $('#fees-message').removeClass('alert-danger alert-success').hide()
        $( ".invalid-feedback" ).remove();
        $.each( $('.form-control') , function( key, value ) {
            $(this).removeClass('is-invalid')
        });
    }

    $('#new_fee').submit(function(e){
        e.preventDefault();

        resetMessages();

        var data_post = $(this).serialize();

        if (parseInt($('#fees_member_id').val()) != 0 && parseFloat($('#fees').val()) != 0){
            //new fee
            $.ajax({
                url: $('#new_fee').prop('action'),
                type:'POST',
                data: data_post,
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        $('#fees-message').addClass('alert-success').html(data.success).show(); 
                        $('#feesModal').modal('hide');

                        loadFees();
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