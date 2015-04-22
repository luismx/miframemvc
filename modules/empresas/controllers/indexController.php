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

	public function getEmpresasValidas() {
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

	/**
	 * *
	 * ajax
	 * @return String realiza un ajax para activar/desactivar las empresas del usuario, buscar rfc
	 */

	public function getRfc() {
		if (isset($_POST['rfc'])) {
			$post   = $this->_funciones->quitarEspacios($_POST['rfc']);
			$valido = $this->_funciones->validarRfc($post);
			if ($valido) {
				echo $rfc = $this->_modelo->getRfc($post);
				if (is_array($rfc) and count($rfc) > 0) {
					foreach ($rfc as $row) {
						echo "$row";
					}
				}
			} else {
				echo 0;
			}
		}
	}

	public function editar() {
		if (isset($_POST['id'])) {
			echo "Empresa editada.";
		}
	}

	public function activar() {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			return $this->_modelo->setStatus($id, 1);
		}
	}

	public function desactivar() {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			return $this->_modelo->setStatus($id, 0);
		}
	}

	public function buscarEmpresa($rfc) {
		$existe = $this->_funciones->validarRfc($rfc);
	}
}
