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

function mostrarForm(id){
	var form = $('#'+id);
	$('#'+id+', input').each(function(i,val) {
		$(val).removeAttr('readonly').val('');
	});
	$('#'+id+', #registrar, #upload').fadeIn('slow');
}

function buscarEmpresa(id){
	$.ajax({url:url, type:'POST',dataType:'json',data:{id:id}})
	.done(function(data) {
		$.each(data, function(index,val){
			$.each(val,function(key,value){
				$('#campos input').each(function(i,v) {
					if (v.name == key) {
						$('input[name="'+key+'"]').val(value).attr('readonly',true);
					}
				});
			});
		});
		$('#campos, #solicitar').fadeIn('slow');
		console.log(data);
	}).fail(function(x,y,z) {
		console.log(x+y+z);
	});
}

function buscarMatriz(rfc){
	$.ajax({url:'getMatriz', type:'POST',dataType:'json',data:{rfc:rfc}})
	.done(function(data) {
		$.each(data, function(index,val){
			$.each(val,function(key,value){
				$('#campos input').each(function(i,v) {
					if (v.name == key) {
						$('input[name="'+key+'"]').val(value).attr('readonly',true);
					}
				});
			});
		});
		$('#campos, #solicitar').fadeIn('slow');
		console.log(data);
	}).fail(function(x,y,z) {
		console.log(x+y+z);
	});
}

function buscarSucursal(id){
	$.ajax({url:'getMatriz', type:'POST',dataType:'json',data:{rfc:rfc}})
	.done(function(data) {
		$.each(data, function(index,val){
			$.each(val,function(key,value){
				$('#campos input').each(function(i,v) {
					if (v.name == key) {
						$('input[name="'+key+'"]').val(value).attr('readonly',true);
					}
				});
			});
		});
		$('#campos, #solicitar').fadeIn('slow');
		console.log(data);
	}).fail(function(x,y,z) {
		console.log(x+y+z);
	});
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
		if ($('#miRfc').val() != "") {
			$('#campos, #solicitar, #registrar').fadeOut('fast');
			$('#campos input[type="text"]').val('');
			
			$.post('validarRfc', {rfc:$('#miRfc').val()}, function(data) {
				if (data == 1) {
					$("#existe").fadeIn('fast');
					$.ajax({
						url:'getMatriz',type:'POST',dataType:'json',data:{rfc:$("#miRfc").val()}
					}).done(function(dato){
						if (dato.length > 0) {
							buscarMatriz($("#miRfc").val());
							$('#existe').fadeIn('fast');
						 	$('#upload').fadeOut('fast');
						}else{
							$('#existe').fadeOut('fast');
							jsDialogoFuncion('dialogo','RFC no registrado, ¿quieres dar de alta una empresa con este RFC?','Alta',mostrarForm,'campos','Aceptar','Cancelar');
						}
					});
				}
				else{
					jsDialogoAlerta('dialogo','Formato de RFC no válido.','','','Aceptar');
				}
			});


		}
	});
	
	
	$('#empresa').click(function(){
		if ($('#miRfc').val() != "") {
			
			buscarMatriz($('#miRfc').val());
		}
	});
});