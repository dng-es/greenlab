jQuery(document).ready(function(){
    $(document).on('click', '#backup',function(e){
        e.preventDefault();
        var elem = $(this),
            url = elem.data('url');

        Swal.fire({
            title: i18n.general.AreYouSure,
            text: i18n.general.Backup_alert,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: i18n.general.CancelMsg,
            confirmButtonText: i18n.general.ConfirmMsg
        }).then((result) => {
            if (result.value) {
                location.href = url;      
            }
        })
    });	
});