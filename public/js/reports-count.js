
jQuery(document).ready(function(){
    countMembers();
    countIE();
    //countProducts();
    countToday();


    //cada 20 segundos
    setInterval('countMembers()',20000);
    setInterval('countIE()',20000);
    //setInterval('countProducts()',20000);
    setInterval('countToday()',20000);
});


function countMembers(){
    var elem = $("#count-members"),
        url = elem.data('pourl'),
        ini = parseInt(elem.html());

    $.ajax({
        url: url,
        type:'GET',
        success: function(data) {
            elem.next('.count-loading').hide();
            elem.show().countTo({
                from: ini,
                to: data,
                speed: 700,
                decimals: 0,
                separator: ','
            });
        },
        error: function(data){
            elem.html('??')
        }
    });
};

function countIE(){
    var elem = $("#count-ie"),
        url = elem.data('pourl'),
        ini = parseInt(elem.html());

    $.ajax({
        url: url,
        type:'GET',
        success: function(data) {
            elem.next('.count-loading').hide();
            elem.next().next('.counter-legend').show();
            elem.show().countTo({
                from: ini,
                to: data,
                speed: 700,
                decimals: 2,
                separator: ','
            });
        },
        error: function(data){
            elem.html('??')
        }
    });
};

function countProducts(){
    var elem = $("#count-products"),
        url = elem.data('pourl'),
        ini = parseInt(elem.html());

    $.ajax({
        url: url,
        type:'GET',
        success: function(data) {
            elem.next('.count-loading').hide();
            elem.show().countTo({
                from: ini,
                to: data,
                speed: 700,
                decimals: 0,
                separator: '.'
            });
        },
        error: function(data){
            elem.html('??')
        }
    });
};

function countToday(){
    var elem = $("#count-today"),
        url = elem.data('pourl'),
        ini = parseInt(elem.html());

    $.ajax({
        url: url,
        type:'GET',
        success: function(data) {
            elem.next('.count-loading').hide();
            elem.next().next('.counter-legend').show();
            elem.show().countTo({
                from: ini,
                to: parseFloat(data),
                speed: 700,
                decimals: 2,
                separator: ','
            });
        },
        error: function(data){
            elem.html('??')
        }
    });
};