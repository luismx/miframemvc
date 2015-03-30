<?php

/* 
 * @Dev Luis Perera
 */

class indexController extends dashboardController{
    private $_modelo;
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('index','dashboard');
    }
    
    public function index() {
        $miCon = $this->_modelo->getCon();
        $this->_view->renderizar('index');
    }
}

