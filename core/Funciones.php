<?php
class Funciones {
	public static function clean($str) {$miVar = htmlentities(strip_tags($str), ENT_QUOTES);
		return extract(array_map('clean', $miVar));
	}
	#resolver porque no puedo llamar la funcion clean desde aqui para ser usado en todo el sistema
	public static function getHash($algoritmo, $dato, $llave) {
		$hash = hash_init($algoritmo, HASH_HMAC, $llave);
		hash_update($hash, $dato);

		return hash_final($hash);
	}

	public static function redireccionar($ruta = false) {
		if ($ruta) {
			header('location:'.BASE_URL.$ruta);
		} else {
			header('location:'.BASE_URL);
		}
	}

	public static function validarRfc($rfc) {
		$rfcUsuario  = $rfc;
		$cuartoValor = substr($rfc, 3, 1);
		//RFC Persona Moral.
		if (ctype_digit($cuartoValor) && strlen($rfc) == 12) {
			$letras    = substr($rfc, 0, 3);
			$numeros   = substr($rfc, 3, 6);
			$homoclave = substr($rfc, 9, 3);
			if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
				return true;
			}
			//RFC Persona Física.
		} else if (ctype_alpha($cuartoValor) && strlen($rfc) == 13) {
			$letras    = substr($rfc, 0, 4);
			$numeros   = substr($rfc, 4, 6);
			$homoclave = substr($rfc, 10, 3);
			if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
				return true;
			}
		} else {
			return false;
		}
	}

	public static function validarEmail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {

			return false;
		}
	}

	public static function cambiarFecha($fecha, $lang) {
		$fecha = str_replace('/', '-', $fecha);
		if ($lang == 'db') {
			return $date = date('Y-m-d', strtotime($fecha));
		} else if ($lang == 'es') {
			return $date = date('d/m/Y', strtotime($fecha));
		} else if ($lang == 'en') {
			return $date = date('m/d/Y', strtotime($fecha));
		}
	}

	public static function recortarImagen($nombre, $nuevoNombre, $x, $y) {
		include_once 'libs/upload/class.upload.php';

		if (isset($_FILES[$nombre])) {
			$handle = new upload($_FILES[$nombre]);
			if ($handle->uploaded) {
				$handle->file_new_name_body = $nuevoNombre;
				$handle->image_resize       = true;
				$handle->file_overwrite     = true;
				$handle->file_new_name_ext  = 'png';
				$handle->image_x            = $x;
				$handle->image_y            = $y;
				$handle->process(ROOT.'modules/usuarios/views/index/img/');
				if ($handle->processed) {
					$handle->clean();
					return true;
				} else {
					return false;
				}
			} else {
				echo "Ninguna imagen";
			}
		}
	}

	public static function redireccionarInicio() {
		if (isset($_SESSION) and count($_SESSION) > 0) {} else {header('location:'.BASE_URL);}
	}

	public static function getPaises($tipo = false, $item = false) {
		$fila = 0;

		if (($gestor = fopen("utilities/paises.csv", "r")) !== FALSE) {
			if ($tipo == "text") {
				while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
					$numero = count($datos);
					if ($fila > 0) {
						if ($datos[0] == $item) {
							return $datos[3];
						}
					}

					$fila++;
				}
				fclose($gestor);
			} elseif ($tipo == "select") {
				$options = '<option value="0">Elige...</option>';
				while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
					$numero = count($datos);
					if ($fila > 0) {
						if ($item) {$selected = "selected";
						} else {
							$selected = "";
						}

						$options .= "<option value=".$datos[0]." $selected>" .$datos[3]."</option>";
					}

					$fila++;
				}
				fclose($gestor);
			}
		}
	}
}

?>
