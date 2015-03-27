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
            header('location:'.BASE_URL);
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

    public static function acceso($nivel){
        if (isset($_SESSION) and count($_SESSION) > 0) {
            /*
            $obj = new Conexion();
            $getSession = $obj->query('SELECT session_id FROM usuarios WHERE id = '.self::get('usuario','id'));
            $getSession->execute();
            $session = $getSession->fetch(PDO::FETCH_ASSOC);
            if($session['session_id'] == session_id()){
                if(self::get('usuario','id_tipo') > $nivel){}
                else
                    header ('location:'.BASE_URL);
            }else
                self::destroy ();*/
        }else
            header('location:'.BASE_URL);
    }
}
?>