function modificarEmpresa(arreglo){
	var id = arreglo[0];
	var metodo = arreglo[1];
	if (metodo == 'editar') {
		var form = arreglo[2];
		$.post('empresas/index/'+metodo, {id:id,form:$('#'+form).serialize()}, function(data) {
			if(data == 1)
				jsDialogoAlerta('dialogo','Se ha llevado a cabo la solicitud, se recargará la pagina.','',recargarPagina,'Aceptar');
		});
	}else{
		$.post('empresas/index/'+metodo, {id:id}, function(data) {
			if (data)
				jsDialogoAlerta('dialogo','Se ha llevado a cabo la solicitud, se recargará la pagina.','',recargarPagina,'Aceptar');
		});
	}
}



$(document).ready(function() {
	$('.editar').click(function(event) {
		var id = $(this).attr('valor');
		var arr = [id,'activar','empresaForm'];
		jsDialogoFuncion('dialogo',$('#empresaForm').html(),'Activar',modificarEmpresa,arr,'Aceptar','Cancelar');
		
	});

	$('.activar').click(function(event) {
		var id = $(this).attr('valor');
		var arr = [id,'activar'];
		jsDialogoFuncion('dialogo','¿Está seguro de activar esta empresa?','Activar',modificarEmpresa,arr,'Aceptar','Cancelar');
	});

	$('.desactivar').click(function(event) {
		var id = $(this).attr('valor');
		var arr = [id,'desactivar'];
		jsDialogoFuncion('dialogo','¿Está seguro de desactivar esta empresa?','Desactivar',modificarEmpresa,arr,'Aceptar','Cancelar');
	});

	$("#buscarEmpresa").click(function(e) {
		//e.preventDefault();
		//alert("hola");
		if ($('#miRfc').text() != "") {
			$.post('empresas/index/getRfc', {rfc: $('#miRfc').val()}, function(data, textStatus, xhr) {
				alert(data);
				console.log("Hola");
			});
		}
	});
});