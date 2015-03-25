<?php
class indexController extends Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        print $this->_req->getMetodo();
        $this->_view->renderizar('index');
    }

    public function registro(){
    	$this->_view->renderizar('registro');
    }
}