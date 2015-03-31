<?php

/* 
 * @Dev Luis Perera
 */

class indexController extends empresasController{
    private $_modelo;
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('index','empresas');
    }
    
    public function index() {
        $this->_view->renderizar('index');
    }

    public function nueva(){
        $this->_view->renderizar('nueva');
    }
}

