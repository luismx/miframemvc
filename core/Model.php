<?php
include_once 'DB/Conexion.php';

class Model{
    protected $_db;
    
    public function __construct(){
        $this->_db = new Conexion();
    }
}
?>

