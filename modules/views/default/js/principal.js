$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 changeYear:true,
 shortYearCutoff: 50,
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);

function fechaNacimiento(name){
	$("input[name='"+name+"']").datepicker();
}

function cambiarFecha(fecha, lang){
	//por ahora solo fecha en formato DB
	var miFecha = fecha.split('-');
	var fecha = "";
	switch(lang){
		case 'es':
			return fecha = miFecha[2]+'/'+miFecha[1]+'/'+miFecha[0];
		break;
		case 'en':
			return fecha = miFecha[1]+'/'+miFecha[2]+'/'+miFecha[0];
		break;
	}
}

function imgVistaPrevia(input){
	if (input.files && input.files[0].length > 0) {
		var reader = new FileReader();
		alert(reader);
		reader.onload = function(e){
			$('#img').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

function validarFormEmpresas(id){
	$('#guardar').val(1);
	$('#'+id).submit();
}

function jsDialogoFuncion(clase,texto,titulo,funcion,valores,btnAceptarTxt,btnCancelarTxt) {
	$('.'+clase).html(texto);
	$('.'+clase).dialog({
		dialogClass:'no-close',modal:true,draggable:false,title:titulo,resizable:false,
		buttons:[{
			text:btnAceptarTxt, click:function(){
				$(this).dialog('close');
				var ejecutar = funcion(valores);
			}
		},
		{
			text:btnCancelarTxt,click:function(){$(this).dialog('close');}
		}]
	});
}

function recargarPagina(){
	location.reload(true);
}

function jsDialogoAlerta(clase,texto,titulo,funcion,btnAceptarTxt){
	$('.'+clase).html(texto);
	$('.'+clase).dialog({
		modal:true,draggable:false,title:titulo,resizable:false,
		buttons:[{text:btnAceptarTxt,click:function(){
			$(this).dialog('close');
			var ejecutar = funcion();
		}}]
	});
}

 