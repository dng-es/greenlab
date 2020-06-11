jQuery(document).ready(function(){

	// $.ajaxSetup({
 //        headers: {
 //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 //        }
 //    });

	$('#random-code').click(function(e){
		e.preventDefault();
		var code = Math.random().toString(36).substring(2, 8) + Math.random().toString(36).substring(2, 8);
		$('#code').val(code);
	})

 	var ini_born_at = $('#born_at').val();

    $('#memberModal').on('hidden.bs.modal', function (e) {
    	resetMessages();
    	$('#member_id').val(0);
    	$('#code').val('');
    	$('#name').val('');
    	$('#last_name').val('');
    	$('#telephone').val('');
    	$('#email').val('');
    	$('#born_at').val(ini_born_at);
    	$('#notes').val('');
    	$('.edit-member').hide();
    	$('.new-member').show();
	})

    function resetform(){
    	resetMessages()
    }

    function resetMessages(){
    	$('#member-message').removeClass('alert-danger alert-success').hide()
        $( ".invalid-feedback" ).remove();
        $.each( $('.form-control') , function( key, value ) {
            $(this).removeClass('is-invalid')
        });
    }

	$('#new_member').submit(function(e){
		e.preventDefault();

        resetMessages();
         
        //agregar la imagen
        var canvas = document.getElementById('canvas'),
        	canvasBlank = document.getElementById('canvas_blank'),
        	dataURL = '';

        //comprobar si el canvas esta vacio
        if(canvas.toDataURL() != canvasBlank.toDataURL()){    	
	        dataURL = canvas.toDataURL();

	        var block = dataURL.split(";");
			// Get the content type of the image
			var contentType = block[0].split(":")[1];// In this case "image/gif"
			// get the real base64 content of the file
			var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

			// Convert it to a blob to upload
			var blob = b64toBlob(realData, contentType);
        }

        var data_post = $(this).serialize() + '&imgBase64=' + dataURL,
        	member_id = parseInt($('#member_id').val());

        if (member_id == 0){
        	//new member
	        $.ajax({
	            url: "/member/new",
	            type:'POST',
	            data: data_post,
	            success: function(data) {
	                if($.isEmptyObject(data.error)){
	                    $('.new-member').hide();
	                    $('.edit-member').show();
	                    $('#member_id').val(data.data.id);
	                    $('#member-message').addClass('alert-success').html(data.success).show();

	                    var url = $('#sellBtn').attr('href');
	                    $('#sellBtn').attr('href', url + '/' + data.data.id);
	                    
	                }else{
	                    printErrorMsg(data.error);
	                }
	            },
	            error: function(data){
	            	 printErrorMsg(data.responseJSON.errors);
	            }
	        });
        }
        else{
			//EDIT member
	        $.ajax({
	            url: "/member/edit/" + member_id,
	            type:'POST',
	            data: data_post,
	            success: function(data) {
	                if($.isEmptyObject(data.error)){
	                	$('#member-message').addClass('alert-success').html(data.success).show();
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