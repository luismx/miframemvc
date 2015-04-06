function modificarEmpresas(id,tipo,form){
	if(form != false)
		var form = $('#'+form).serialize();
	$.ajax({
		url: 'empresas/'+tipo,
		type: 'POST',
		data: {id: id,form:form},
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}

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
});