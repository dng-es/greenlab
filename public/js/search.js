
jQuery(document).ready(function(){

    $('#search_member').submit(function(e){
        e.preventDefault();
        searchUsers();
    })

    function searchUsers(){
        var elem = $("#search_member"),
            url = elem.prop('action'),
            url_sell = elem.data('sell'),
            val = $('#search_member_value').val();

        $.ajax({
            url: url + '/' + val,
            type:'GET',
            success: function(data) {
                var modal = $('#searchModal'), 
                    container = $('#searchModalBody'), 
                    content = '';

                container.html('')
                if (data.length == 0) content = "No se encuentran resultados.";
                else if(data.length == 1) location.href = url_sell + "/" + data[0].id;
                else{
                    data.forEach(function(item){
                      content += '<a href="' + url_sell + '/' + item.id + '">' + item.name + ' ' + item.last_name + '</a><br>';
                    });

                    modal.modal('show')
                }

                container.html(content)

            },
            error: function(data){
                elem.html('??')
            }
        });
    };
});