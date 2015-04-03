<?php
/**
* Luis Perera
*/
class Session
{
	public static function init(){
		session_start();
	}

	public static function destroy($llave = false){
		if ($llave) {
			if (isset($_SESSION[$llave])) {
				# code...
			}
		}else
			session_destroy();
	}
}
?>