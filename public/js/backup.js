jQuery(document).ready(function(){
    $(document).on('click', '#backup',function(e){
        e.preventDefault();
        var elem = $(this),
            url = elem.data('url');

        Swal.fire({
            title: "¿Estas seguro?",
            text: "Seguro que deseas realizar la copia de seguridad. Este proceso puede durar unos minutos",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Cancelar",
            confirmButtonText: "Confirmar"
        }).then((result) => {
            if (result.value) {
                location.href = url;      
            }
        })
    });	
});