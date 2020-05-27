function Confirma(Mensaje, Destino, Title, CancelButton, ConfirmButton){

	Title || (Title = "¿Estas seguro?");
	CancelButton || (CancelButton = "Cancelar");
	ConfirmButton || (ConfirmButton = "Confirmar");

	Swal({
		title: Title,
		text: Mensaje,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		cancelButtonText: CancelButton,
		confirmButtonText: ConfirmButton,
		closeOnConfirm: false
	},
	function(){
		location.href=Destino;
	});
}