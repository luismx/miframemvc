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
        $rfcValido = $this->_funciones->validarRfc($rfc);
        $emailValido = $this->_funciones->validarEmail($email);
        $hash = $this->_funciones->getHash('sha1',$clave,HASH_KEY);
        $fecha = $this->_funciones->cambiarFecha($fecha_nacimiento,'bd');
        
        if($rfcValido == true and $emailValido == true){
            $data = array('TABLE'=>'usuarios','COLUMNS'=>'id_tipo,nombre,apellido_paterno,apellido_materno,fecha_nacimiento,email,usuario,clave,rfc','VALUES'=>'?,?,?,?,?,?,?,?,?');
            $values = array($id_tipo,$nombre,$apellido_paterno,$apellido_materno,$fecha,$email,$usuario,$hash,$rfc);
            $id = $this->buscar($id_tipo, $usuario, $hash);

            if(!$id){
                $q = $this->_modelo->guardar($data,$values);
                if($q)
                    $this->_view->success = '<div class="alert alert-success" role="alert">Datos guardados, puedes iniciar sesión</div>';
                else
                    $this->_view->warning = '<div class="alert alert-warning" role="alert">Error al guardar su información, intente de nuevo</div>';
            }else
                $this->_view->danger = '<div class="alert alert-danger" role="alert">No puede registrar el mismo usuario, verfique su información</div>';
        }else
        	$this->_view->warning = '<div class="alert alert-warning" role="alert">El RFC o E-mail no es válido, verifique su información</div>';

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
