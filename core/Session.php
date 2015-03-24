<?php
class Session
{
    public static function init() {
        session_start();
    }
    
    public static function destroy($clave = false){
         if($clave){
            if(is_array($clave)){
                for($i = 0; $i < count($clave); $i++){
                    if(isset($_SESSION[$clave[$i]])){
                        unset($_SESSION[$clave[$i]]);
                    }
                }
            }
            else{
                if(isset($_SESSION[$clave])){
                    unset($_SESSION[$clave]);
                }
            }
        }
        else{
            session_destroy();
        }
    }
    
    public static function set($clave,$valor){
        if(!empty($clave))
            $_SESSION[$clave] = $valor;
    }
    
    public static function get($clave1,$clave2 = false){
        if(isset($clave2))
            return $_SESSION[$clave1][$clave2];
        else
            return $_SESSION[$clave1];
    }
}
