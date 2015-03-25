<?php
class Funciones{ 
    #resolver porque no puedo llamar la funcion clean desde aqui para ser usado en todo el sistema
    public static function getHash($algoritmo,$dato, $llave){
        $hash = hash_init($algoritmo, HASH_HMAC, $llave);
        hash_update($hash, $dato);
        
        return hash_final($hash);
    }
    
    public static function redireccionar($ruta = false)
    {
        if($ruta){
            header('location:' . BASE_URL . $ruta);
            exit;
        }
        else{
            header('location:' . BASE_URL);
            exit;
        }
    }
    
}
?>