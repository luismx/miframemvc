<?php

/* 
 * @Dev Luis Perera
 */
class indexModel extends Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function getDatosUsuario($arr){
        $select = $this->_dbf->get_select_query($arr);
        $q = $this->_db->query($select);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
    
    /*public function getDatosUsuario($arr){
        $select = $this->_dbf->get_select_query($arr);
        $q = $this->_db->query($select);
        return $q->fetch(PDO::FETCH_ASSOC);
    }*/
}

