$(document).ready(function() {
	$('.editar').click(function(event) {
		var id = $(this).attr('valor');
		$('#idEmpresa').val(id);
		$('#editar').modal('show');
	});

	$('.activar').click(function(event) {
		var id = $(this).attr('valor');
		$('#idEmpresa').val(id);
		$('#activar').modal('show');
	});

	$('.desactivar').click(function(event) {
		var id = $(this).attr('valor');
		$('#idEmpresa').val(id);
		$('#desactivar').modal('show');
	});

	$('#btnDesactivar').click(function(e) {
		
	});
});