<?php
class indexController extends registroController{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->_view->renderizar('registro');
    }
}
