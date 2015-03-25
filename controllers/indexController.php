<?php
class indexController extends Controller{
    private $_modelo;
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('index');
    }
    
    public function index() {
        if (isset($_POST['sesion']) and $_POST['sesion'] > 0){
            $this->login();
        }
        else
            $this->_view->renderizar('index');
    }
    
    public function login(){
        function clean($str) { return htmlentities(strip_tags($str), ENT_QUOTES); } 
        extract(array_map('clean',$_POST));
        $hash = $this->_funciones->getHash('sha1',$claveUsuario,HASH_KEY);
        $data = array('TABLE'=>'usuarios','COLUMNS'=>'status','WHERE'=>"id_tipo = $tipoUsuario AND usuario = '$nombreUsuario' AND clave = '$hash'");
        $status = $this->_modelo->getStatusUsuario($data);
        if(isset($status) and $status > 0){
            if($status == 1)
                $this->_funciones->redireccionar('dashboard');
            else
                $this->_funciones->redireccionar('usuarios');
        }
        else
            $this->_funciones->redireccionar();
        
    }
}