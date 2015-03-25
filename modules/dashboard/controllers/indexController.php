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
        var_dump($miCon);
        $this->_view->renderizar('index');
    }
}

