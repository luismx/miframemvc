<?php
/**
* Luis Perera
*/
class indexController extends usuariosController
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->_view->renderizar('index');
	}

	public function cerrar(){
		Session::destroy();
		header('location:'.BASE_URL);
	}

	public function editar(){
		$this->_view->renderizar('editar');
	}

	public function guardar($post,$tabla){
		
		if (is_array($post) and count($post) > 0) {
			$columnas = $this->getCampos($tabla);
			if ($columnas) {
				foreach ($columnas as $nombreC => $valorC) {
					# code...
				}
			}
		}
	}
}
?>