	$(document).ready(function(){
		$('#pass, #claveUsuario').val();

		$('#btnLogin').click(function(){
			if ($('#tipoUsuario').val() != 0 && $('#nombreUsuario').val()!= "" && $('#claveUsuario').val() != "") {
				$('#sesion').val(1);
				$("#loginForm").submit();
			}
			else if($('#tipoUsuario').val() == 0){
				$('#error').text('Es necesario elegir un tipo de usuario');
				$('#tipoUsuario').focus();
			}else if($('#nombreUsuario').val() == ""){
				$('#error').text('Es necesario el nombre de usuario');
				$('#nombreUsuario').focus();
			}else if($('#claveUsuario').val() == ""){
				$('#error').text('Es necesario la clave de usuario');
					$('#claveUsuario').focus();
			}			
		});
	});