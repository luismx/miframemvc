<?php
class registroController extends Controller{
    private $_modelo;
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('registro');
    }
    
    public function index() {
    	//$var = $this->_req->getArgs();
    	$this->_view->tipos = $this->_modelo->getTipos();
        $this->_view->renderizar('index');
    }
    
    public function setUsuario(){
        function clean($str) { return htmlentities(strip_tags($str), ENT_QUOTES); }
        extract(array_map('clean',$_POST));
        $hash = $this->_funciones->getHash('sha1',$clave,HASH_KEY);
        $data = array('TABLE'=>'usuarios','COLUMNS'=>'id_tipo,nombre,apellido_paterno,apellido_materno,fecha_nacimiento,email,usuario,clave,rfc','VALUES'=>'?,?,?,?,?,?,?,?,?');
        $values = array($id_tipo,$nombre,$apellido_paterno,$apellido_materno,$fecha_nacimiento,$email,$usuario,$hash,$rfc);
        $id = $this->_modelo->setUsuario($data,$values);        
    }
    
    public function getUsuario(){
        
    }
}
