<?php

/* 
 * @Dev Luis Perera
 */

class indexController extends empresasController{
    private $_modelo;
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('index','empresas');
        $this->_view->numEmpresas = $this->_modelo->getNumEmpresas();
    }
    
    public function index() {
        $this->_view->renderizar('index');
    }

    public function nueva(){
        if (isset($_POST['guardar']) and $_POST['guardar'] == 1) {
            $this->guardar($_POST);
        }
        $this->_view->renderizar('nueva');
    }

    public function guardar($post){
        $errores = array();
        $columnas = $this->_modelo->getColumnas('empresas');

        if (is_array($columnas) and count($columnas) > 0) {
            
        }

        if (count($errores) > 0) 
            return $errores;
    }
}

