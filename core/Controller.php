<?php
abstract class Controller
{
    protected $_view; #traer la vista
    protected $_req; #traer los datos de la URL
    protected $_f; #funciones
    
    public function __construct() {
        $this->_req = new Request();
        $this->_view = new View($this->_req);
    }
    
    abstract function index();
    
    protected function loadModel($modelo,$modulo = false){
        $modelo = $modelo . 'Model';
        $rutaModelo = ROOT . 'models' . DS . $modelo . '.php';
        
        if(!$modulo)
            $modulo = $this->_req->getModulo();
        
        if($modulo){
           if($modulo != 'default')
               echo $rutaModelo = ROOT . 'modules' . DS . $modulo . DS . 'models' . DS . $modelo . '.php';
        }
        
        if(file_exists($rutaModelo)){
            require_once $rutaModelo;
            $modelo = new $modelo;
            return $modelo;
        }
        else{
            throw new Exception('Error de modelo');
        }
    }
    
    
}
?>