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
    	$tipo = Session::get('usuario','id_tipo');
    	
        switch ($tipo) {
            case '1':
                $this->_view->renderizar('cliente');
                break;
            case '2':
                $this->_view->renderizar('comisionista');
                break;
            case '1':
                $this->_view->renderizar('operador');
                break;
            case '1':
                $this->_view->renderizar('administrador');
                break;
        }
    }
}

