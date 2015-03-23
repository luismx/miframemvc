<?php
abstract class Controller
{
    protected $_view;
    protected $_req;
    
    public function __construct() {
        $this->_req = new Request();
        $this->_view = new View($this->_req);
    }
    
    abstract function index();
    
    protected function loadModel($modelo,$modulo = false){
        $modelo = $modelo.'Model';
        $rutaModelo = ROOT.'models'.DS.$modelo.'.php';
        
        if(!$modelo){
            $modulo = $this->_req->getModulo();
        }
    }
}
?>