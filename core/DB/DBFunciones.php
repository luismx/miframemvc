<?php
class DBFunciones{
    private $_con;
    function __construct(){
        $this->_con = new Conexion();
    }
    public static function get_insert_query($p) {

        $data = array($p['TABLE'], $p['COLUMNS'], $p['VALUES']);
        return vsprintf("INSERT INTO %s (%s) VALUES (%s)", $data);
    }

    public static function get_update_query($p) {
        $data = array($p['TABLE'], $p['COLUMNS'], $p['WHERE']);
        return vsprintf("UPDATE %s SET %s WHERE %s", $data);
    }

    public static function get_select_query($p) {
        if(!isset($p['WHERE'])){
            $data = array($p['COLUMNS'],$p['TABLE']);
            return vsprintf("SELECT %s FROM %s", $data);
        }else{
            $data = array($p['COLUMNS'],$p['TABLE'], $p['WHERE']);
            return vsprintf("SELECT %s FROM %s WHERE %s", $data);
        }
    }

    public static function get_delete_query($p) {
        $data = array($p->table, $p->property_id);
        return vsprintf("DELETE FROM %s WHERE %s = ?", $data);
    }

    public static function get_composer_query($p, $compuesto) {
        $data = array($p->property_id, $p->table, $compuesto);
        return vsprintf("SELECT %s FROM %s WHERE %s = ?", $data);
    }

    public static function updateColumna($tabla, $columna,$valor,$id){
        $data = array('TABLE' =>$tabla,'COLUMNS'=>"$columna",'WHERE'=>"id = $id");
        echo $update = $this->get_update_query($data);
        $q = $this->_con->prepare($update);
        $q->execute($valor);
        return $q;
    }
}
?>

