<?php

/*
 * @Dev Luis Perera
 */

class indexController extends empresasController {
	private $_modelo;
	public function __construct() {
		parent::__construct();
		$this->_modelo            = $this->loadModel('index', 'empresas');
		$this->_view->numEmpresas = $this->_modelo->getNumEmpresas();
	}

	public function index() {
		$this->_view->empresas = $this->generarthEmpresas();
		$this->_view->renderizar('index');
	}

	public function nueva() {
		if (isset($_POST['guardar']) and $_POST['guardar'] == 1) {
			$this->guardar($_POST);
		}

		$this->_view->renderizar('nueva');
	}

	public function guardar($post) {
		$errores = array();
		$this->_funciones->clean($post);

		$columnas = $this->_modelo->getColumnas('empresas');

		if (is_array($columnas) and count($columnas) > 0) {

		}

		if (count($errores) > 0) {
			return $errores;
		}
	}

	public function generarthEmpresas() {
		$empresas = $this->_modelo->generarthEmpresas();

		if (is_array($empresas) and count($empresas) > 0) {
			$i = 1;
			foreach ($empresas as $row) {
				if ($row[5] == 0) {
					$arr[] = "<tr class='danger'><td>$i</td><td>" .$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td><button class='btn btn-default editar' valor='".$row[6]."'><a class='glyphicon glyphicon-pencil'></a></button></td><td><button type='button' class='btn btn-default activar' title='Activar' valor='".$row[6]."'><a class='glyphicon glyphicon-ok'></a></button></tr>";
				} else {
					$arr[] = "<tr><td>$i</td><td>" .$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td><button type='button' class='btn btn-default editar' valor='".$row[6]."'><a class='glyphicon glyphicon-pencil'></a></button></td><td><button type='button' class='btn btn-default desactivar' title='Desactivar' valor='".$row[6]."'><a class='glyphicon glyphicon-remove'></a></button></tr>";
				}

				$i++;
			}

			return $arr;
		}
	}

	public function editar($id) {

	}

	public function activar($id) {

	}

	public function desactivar($id) {

	}
}
