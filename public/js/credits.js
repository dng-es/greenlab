
jQuery(document).ready(function(){

    var page_credits = 1;
    
    loadCredits();

    function loadCredits(){
        $(".loading_credits" ).show()
        var e = $("#credits" )
            url = e.data('pourl') + "?page=" + page_credits
        e.html('').load( url , function() {
            $(".loading_credits" ).hide()
        });
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

    function printErrorMsg (errors) {
        $.each( errors , function( key, value ) {
            $('#' + key).addClass('is-invalid')
            $('#' + key).after('<div class="invalid-feedback" role="alert"><strong>' + value + '</strong></div>')
        });
    }
});