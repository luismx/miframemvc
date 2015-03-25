<?php

/* 
 * @Dev Luis Perera
 */

class indexModel extends Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function getCon(){
        return $this->_db;
    }
}

