<?php

/* 
 * @Dev Luis Perera
 */

class indexModel extends Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function getColumna($tabla,$columna,$id){
        return $this->_dbf->sql_get_columna($tabla,$columna,$id);
    }
}

