var page_warehouses = 1;

loadWarehouses();

function loadWarehouses(){
    $(".loading_warehouses" ).show()
    var e = $("#warehouses")
        url = e.data('pourl') + "?page=" + page_warehouses
    e.html('').load( url , function() {
        $(".loading_warehouses" ).hide()
    });
} 

//paginador
$(document).on('click', '#warehouses-paginator a',function(event)
{
    event.preventDefault();

    $('li').removeClass('active');
    $(this).parent('li').addClass('active');

    var myurl = $(this).attr('href');
    page_warehouses = $(this).attr('href').split('page=')[1];

    loadWarehouses();
});     

function printErrorMsg (errors) {
    $.each( errors , function( key, value ) {
        $('#' + key).addClass('is-invalid')
        $('#' + key).after('<div class="invalid-feedback" role="alert"><strong>' + value + '</strong></div>')
    });
}