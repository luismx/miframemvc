<?php
import('DB.Conexion');

class Model{
    protected $_db;
    
    public function __construct(){
        $this->_db = new Conexion();
    }
}
?>

