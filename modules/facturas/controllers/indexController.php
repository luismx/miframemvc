<?php

/* 
 * @Dev Luis Perera
 */

class indexController extends facturasController{
    private $_modelo;
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('index','facturas');
        $this->_view->numEmpresas = $this->_modelo->getNumEmpresas();
        $this->_view->numFacturas = $this->_modelo->getNumFacturas();
    }
    
    public function index() {
    	$this->guardar($_POST);
        $this->_view->renderizar('index');
    }

    public function guardar($post){
    	var_dump($this->_funciones->clean($_POST));
    }
}