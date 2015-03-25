<?php
class Conexion extends PDO{
    function __construct() {
        parent::__construct(DB_DRIVER.':host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASS);
    }
}
?>