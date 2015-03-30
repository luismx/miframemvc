<?php
/**
* Luis Perera
*/
class indexController extends usuariosController
{
	private $_modelo;

	function __construct()
	{
		parent::__construct();
		$this->_modelo = $this->loadModel('index');

		$this->_view->getTipos = $this->_modelo->getTipos();
		$this->_view->errores = array();

		//$this->_view->datosUsuario = array();
	}

	public function index(){
		$this->_view->datosUsuario = $this->_modelo->getDatosUsuario(Session::get('usuario','id'));
		$this->_view->renderizar('index');
	}

	public function cerrar(){
		Session::destroy();
		header('location:'.BASE_URL);
	}

	public function editar(){
		if ($this->_req->getArgs() and count($this->_req->getArgs()) > 0) {
			$miVariable = $this->_req->getArgs();
			$this->_view->datosUsuario = $this->_modelo->getDatosUsuario($miVariable[0]);
			$tipoUsuario = Session::get('usuario','id_tipo');

			if ($tipoUsuario == 4) {
				if (isset($_POST['guardar']) and $_POST['guardar'] == 1){
					$datosGuardados = $this->guardar($_POST, 'usuarios',$miVariable[0]);
					$this->_view->datosUsuario = $this->_modelo->getDatosUsuario($miVariable[0]);
				}
			}
			else{
				if ($miVariable[0] != Session::get('usuario','id'))
					$this->_funciones->redireccionar('usuarios');
				else{
					if (isset($_POST['guardar']) and $_POST['guardar'] == 1){
						$datosGuardados = $this->guardar($_POST, 'usuarios',$miVariable[0]);
						$this->_view->datosUsuario = $this->_modelo->getDatosUsuario($miVariable[0]);
					}
				}
			}
		}
		if ($this->_view->datosUsuario == 0) 
			$this->_view->mensaje = "Datos guardados";
		$this->_view->renderizar('editar');
	}

	public function guardar($post,$tabla,$id){
		$errores = array();
		if (is_array($post) and count($post) > 0) {
			$columnas = $this->_modelo->getCampos($tabla);
			if ($columnas) {
				if (isset($_FILES)) {
					if ($_FILES['img']['name'] != "") {
						$nombre = $post['rfc'].'_'.$post['usuario'];
						$img = $this->guardarImagen($nombre);
						if ($img) {
							$this->_modelo->updateColumna('usuarios','img',$nombre.'.png',$id);
						}else
							$this->_view->errores['img'] = "Error al subir la imagen";
					}
				}

				foreach ($columnas as $llaveColumna => $valorColumna) {
					foreach ($post as $llavePost => $valorPost) {
						if ($valorPost != "" and $llavePost == $llaveColumna) {
							if ($llavePost == 'clave') {
								$this->_modelo->updateColumna('usuarios','clave',$this->_funciones->gethash('sha1',$valorPost,HASH_KEY),$id);
							}
							elseif ($llavePost == 'fecha_nacimiento') {
								$this->_modelo->updateColumna('usuarios','fecha_nacimiento',$this->_funciones->cambiarFecha($valorPost,'db'),$id);
							}elseif ($llavePost == 'email') {
								$email = $this->_funciones->validarEmail($valorPost);
								if ($email) 
									$this->_modelo->updateColumna('usuarios','email',$valorPost,$id);
								else
									$this->_view->errores[$llavePost] = "Email inválido";
							}
							else
								$actualizado = $this->_modelo->updateColumna('usuarios',$llavePost,$valorPost,$id);
								if (!$actualizado) 
									$this->_view->errores[$llavePost] = "Error, verifique su información";
						}
					}
				}

			}
			$this->_modelo->updateSession($id);
			if (count($errores) > 0) 
				return var_dump($errores);
			else
				return 0;
		}
	}

	public function guardarImagen($nombre){
		var_dump($_FILES);
		if (isset($_FILES) and $_FILES['img']['name'] != "") {
			return $img = $this->_funciones->recortarImagen('img',$nombre,'100','70');
		}
	}
}
?>