<?php
class registroController extends Controller{
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index() {
    	//$var = $this->_req->getArgs();
    	
        
        $this->_view->renderizar('index');
    }
}
