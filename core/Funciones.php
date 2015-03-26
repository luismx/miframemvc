<?php
class Funciones{ 
    function clean($str) { return htmlentities(strip_tags($str), ENT_QUOTES); }
    #resolver porque no puedo llamar la funcion clean desde aqui para ser usado en todo el sistema
    public static function getHash($algoritmo,$dato, $llave){
        $hash = hash_init($algoritmo, HASH_HMAC, $llave);
        hash_update($hash, $dato);
        
        return hash_final($hash);
    }
    
    public static function redireccionar($ruta = false){
        if($ruta){
            header('location:' . BASE_URL . $ruta);
            exit;
        }
        else{
            header('location:' . BASE_URL);
            exit;
        }
    }
    
    public static function validarRfc($rfc){
        $rfcUsuario = $rfc;
         $cuartoValor = substr($rfc, 3, 1); 
        //RFC Persona Moral. 
        if (ctype_digit($cuartoValor) && strlen($rfc) == 12) { 
            $letras = substr($rfc, 0, 3); 
            $numeros = substr($rfc, 3, 6); 
            $homoclave = substr($rfc, 9, 3); 
            if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) { 
                return true; 
            } 
        //RFC Persona Física. 
        } else if (ctype_alpha($cuartoValor) && strlen($rfc) == 13) { 
            $letras = substr($rfc, 0, 4); 
            $numeros = substr($rfc, 4, 6); 
            $homoclave = substr($rfc, 10, 3); 
            if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) { 
                return true; 
            } 
        }else { 
            return false; 
        }
    }
    
    public static function validarEmail($email){
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
            return true;
        else
            return false;
    }

    public static function cambiarFecha($fecha,$lang){
        if ($lang == 'bd' or $lang == 'db') 
            $date = date('Y-m-d', strtotime($fecha));
        else if($lang == 'es')
            $date = date('d/m/Y', strtotime($fecha));
        else if($lang == 'en')
            $date = date('m/d/Y', strtotime($fecha));
        else
            return false;

        return $date;
    }
}
?>