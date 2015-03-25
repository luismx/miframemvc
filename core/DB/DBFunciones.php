<?php
class DBFunciones{
    public static function get_insert_query($p) {

        $data = array($p['table'], $p['columns'], $p['VALUES']);
        return vsprintf("INSERT INTO %s (NULL, %s) VALUES (%s)", $data);
    }

    public static function get_update_query($p) {
        $data = array($p->table, $p->update_string, $p->property_id);
        return vsprintf("UPDATE %s SET %s WHERE %s = ?", $data);
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
}
?>

