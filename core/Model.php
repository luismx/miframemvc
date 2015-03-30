<?php
include('DB/Conexion.php');
include('DB/DBFunciones.php');

class Model{
    protected $_db;
    protected $_dbf;
    public function __construct(){
        $this->_db = new Conexion();
        $this->_dbf = new DBFunciones();
    }
}
?>

