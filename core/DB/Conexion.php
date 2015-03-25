<?php
include_once 'DBFunciones.php';
    
class Conexion extends PDO{
    protected $_dbf;
    
    function __construct() {
        parent::__construct('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASS);
        $this->_dbf = DBFunciones();
    }
}
?>