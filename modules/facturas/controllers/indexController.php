<?php

/* 
 * @Dev Luis Perera
 */

class indexController extends facturasController{
    private $_modelo;
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('index','facturas');
    }
    
    public function index() {

        $this->_view->renderizar('index');
    }
}

