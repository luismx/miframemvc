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

function registroForm(){
	if ($("select[name='id_tipo']").val() > 0 && $("input[name='nombre']").val() != "" && $("input[name='apellido_paterno']").val() != "" && $("input[name='apellido_materno']").val() != "" && $("input[name='fecha_nacimiento']").val() != "" && $("input[name='email']").val() != "" && $("input[name='usuario']").val() != "" && $("input[name='clave']").val() && $("input[name='rfc']").val() != "") {
		$('#registroForm').submit();
	}
	else{
		$('#errorCampo').fadeIn('slow');
		if ($("select[name='id_tipo']").val() == "0") 
			$('#errorCampo').append('<pre id="error0">Selecciona el tipo de usuario</pre>').click(function() {
				$("select[name='id_tipo']").focus();
				$('#error0').remove();
				$('#errorCampo, .alert').fadeOut('fast');
			});
		else if ($("input[name='nombre']").val() == "") 
			$('#errorCampo').append('<pre id="error1">Nombre no puede estar vacío</pre>').click(function() {
				$("input[name='nombre']").focus();
				$('#error1').remove();
				$('#errorCampo, .alert').fadeOut('fast');
			});
		else if ($("input[name='apellido_paterno']").val() == "") 
			$('#errorCampo').append('<pre id="error2">Apellido no puede estar vacío</pre>').click(function() {
				$("input[name='apellido_paterno']").focus();
				$('#error2').remove();
				$('#errorCampo, .alert').fadeOut('fast');
			});
		else if ($("input[name='apellido_materno']").val() == "") 
			$('#errorCampo').append('<pre id="error3">Apellido no puede estar vacío</pre>').click(function() {
				$("input[name='apellido_materno']").focus();
				$('#error3').remove();
				$('#errorCampo, .alert').fadeOut('fast');
			});
		else if ($("input[name='fecha_nacimiento']").val() == "") 
			$('#errorCampo').append('<pre id="error4">Fecha de nacimiento no puede estar vacío</pre>').click(function() {
				$("input[name='fecha_nacimiento']").focus();
				$('#error4').remove();
				$('#errorCampo, .alert').fadeOut('fast');
			});
		else if ($("input[name='email']").val() == "") 
			$('#errorCampo').append('<pre id="error5">Fecha de nacimiento no puede estar vacío</pre>').click(function() {
				$("input[name='email']").focus();
				$('#error5').remove();
				$('#errorCampo, .alert').fadeOut('fast');
			});
		else if ($("input[name='usuario']").val() == "") 
			$('#errorCampo').append('<pre id="error6">Nombre de usuario no puede estar vacío</pre>').click(function() {
				$("input[name='usuario']").focus();
				$('#error6').remove();
				$('#errorCampo, .alert').fadeOut('fast');
			});
		else if ($("input[name='clave']").val() == "") 
			$('#errorCampo').append('<pre id="error7">Contraseña no puede estar vacío</pre>').click(function() {
				$("input[name='clave']").focus();
				$('#error7').remove();
				$('#errorCampo, .alert').fadeOut('fast');
			});
		else if ($("input[name='rfc']").val() == "") 
			$('#errorCampo').append('<pre id="error8">RFC no puede estar vacío</pre>').click(function() {
				$("input[name='rfc']").focus();
				$('#error8').remove();
				$('#errorCampo, .alert').fadeOut('fast');
			});
	}
}

function loginForm(){
	if ($('#tipoUsuario').val() != 0 && $('#nombreUsuario').val()!= "" && $('#claveUsuario').val() != "") {
		$('#sesion').val(1);
		$("#loginForm").submit();
	}
	else{
		if($('#tipoUsuario').val() == 0){
			$('#error').text('Es necesario elegir un tipo de usuario').fadeIn('slow');
			$('#tipoUsuario').click(function(){$('#error').text('')});
		}else if($('#nombreUsuario').val() == ""){
			$('#error').text('Es necesario el nombre de usuario');
			$('#nombreUsuario').click(function(){$('#error').text('')});
		}else if($('#claveUsuario').val() == ""){
			$('#error').text('Es necesario la clave de usuario');
			$('#claveUsuario').click(function(){$('#error').text('')});
		}			
	}
}

function fechaNacimiento(name){
	$("input[name='"+name+"']").datepicker();
}

$(document).ready(function(){
	$('#pass, #claveUsuario').val();
	$('#btnLogin').click(function(e){
		e.preventDefault();
		loginForm();
	});

	$('#btnRegistrar').click(function(e) {
		e.preventDefault();
		registroForm();
	});
});