<?php
class View{
    private $_controlador;
    private $_js;
    private $_req;
    private $_rutas;
    private $_template;
    
    public function __construct(Request $r) {
        parent::__construct();
        $this->_controlador = $r->getControlador();
        $this->_js = array();
        $this->_rutas = array();
        $this->_template = STATIC_DIR;
        
        $modulo = $this->req->getModulo();
        $controlador = $this->req->getControlador();
        
        if($modulo){
            $this->_rutas['view'] = ROOT . 'modules' . DS . $modulo . DS . 'views' . DS . $controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'modules/' . $modulo . '/views/' . $controlador . '/js/';
        }
        else{
            $this->_rutas['view'] = ROOT . 'views' . DS . $controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'views/' . $controlador . '/js/';
        }
    }
    
    public function renderizar($vista, $item = false){
        if(is_readable($this->_rutas['view'].$vista.'.html')){
            echo $ruta = $this->_rutas['view'].$vista.'.html';
            
            include_once $this->_rutas['view'].'header.html';
            include_once $this->_rutas['view'].$vista.'.html';
            include_once $this->_rutas['view'].'footer.html';
        }
        else{
            throw new Exception("No existe la vista morro", 1);
        }
    }
}
?>

