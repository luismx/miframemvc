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
    
    public function guardar(){
        function clean($str) { return htmlentities(strip_tags($str), ENT_QUOTES); }
        extract(array_map('clean',$_POST));
        $hash = $this->_funciones->getHash('sha1',$clave,HASH_KEY);
        $data = array('TABLE'=>'usuarios','COLUMNS'=>'id_tipo,nombre,apellido_paterno,apellido_materno,fecha_nacimiento,email,usuario,clave,rfc','VALUES'=>'?,?,?,?,?,?,?,?,?');
        $values = array($id_tipo,$nombre,$apellido_paterno,$apellido_materno,$fecha_nacimiento,$email,$usuario,$hash,$rfc);
        $id = $this->buscar($id_tipo, $usuario, $hash);

        if(!$id){
            $q = $this->_modelo->guardar($data,$values);
            if($q > 0)
                $this->_view->guardado = '<div class="alert alert-success" role="alert">Datos guardados, puedes iniciar sesión</div>';
            else
                $this->_view->error = '<div class="alert alert-danger" role="alert">Error al guardar su información, intente de nuevo</div>';
        }else
            $this->_view->error = '<div class="alert alert-danger" role="alert">No puede registrar el mismo usuario, verfique su información</div>';
        
        $this->_view->tipos = $this->_modelo->getTipos();
        $this->_view->renderizar('index');
    }
    
    public function buscar($id_tipo,$usuario,$clave){
        if(isset($id_tipo)){
            $data = array('TABLE'=>'usuarios','COLUMNS'=>'id','WHERE'=>"id_tipo=$id_tipo AND usuario = '$usuario' AND clave='$clave'");
            return $select = $this->_modelo->buscar($data);
        }
    }
}
