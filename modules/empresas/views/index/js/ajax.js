/* global $ */
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
			if (data == 1)
				jsDialogoAlerta('dialogo','Se ha llevado a cabo la solicitud, se recargará la pagina.','',recargarPagina,'Aceptar');
			else
				jsDialogoAlerta('dialogo','Ha ocurrido un error.','','','Aceptar');
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

	$("#buscarEmpresa").click(function(event) {
		if ($('#miRfc').val() != "") {
			$.post('getRfc', {rfc:$('#miRfc').val()}, function(data) {
				var datos = data.split(',');
				$.each(datos,function(index, el) {
					$('#empresa').append(datos[index].rfc);
				});
			});
			
		}
	});
});