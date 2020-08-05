<?php
require 'persistencia/MedicoDAO.php';
require_once 'persistencia/Conexion.php';

class Medico extends Persona {
	private $tarjetaprofesional;
	private $especialidad_idespecialidad;
	private $medicoDAO;
	private $conexion;

	function getTarjetaProfesional() {
		return $this->tarjetaprofesional;
	}

	function getEspecialidad_Idespecialidad() {
		return $this->especialidad_idespecialidad;
	}

	function Medico($id = '', $nombre = '', $apellido = '', $correo = '', $clave = '', $tarjetaprofesional = '', $especialidad_idespecialidad = '') {
		parent::__construct($id, $nombre, $apellido, $correo, $clave);
		$this->tarjetaprofesional = $tarjetaprofesional;
		$this->especialidad_idespecialidad = $especialidad_idespecialidad;
		$this->conexion = new Conexion();
		$this->medicoDAO = new MedicoDAO($id, $nombre, $apellido, $correo, $clave, $tarjetaprofesional, $especialidad_idespecialidad);
	}

	function registrar() {
		$this->conexion->abrir();
		$this->conexion->ejecutar($this->medicoDAO->registrar());
		$this->conexion->cerrar();
	}

	function actualizar() {
		$this->conexion->abrir();
		$this->conexion->ejecutar($this->medicoDAO->actualizar());
		$this->conexion->cerrar();
	}

	function existeCorreo() {
		$this->conexion->abrir();
		$this->conexion->ejecutar($this->medicoDAO->existeCorreo());
		if ($this->conexion->numFilas() == 0) {
			$this->conexion->cerrar();
			return false;
		} else {
			$this->conexion->cerrar();
			return true;
		}
	}

	function autenticar() {
        $this->conexion->abrir();
        echo $this->medicoDAO->autenticar();
        $this->conexion->ejecutar( $this->medicoDAO->autenticar() );
        if ( $this->conexion->numFilas() == 1 ) {
            $resultado = $this->conexion->extraer();
            $this->id = $resultado[0];
            $this->conexion->cerrar();
            return true;
        } else {
            $this->conexion->cerrar();
            return false;
        }
    }

	function consultar() {
		$this->conexion->abrir();
		$this->conexion->ejecutar($this->medicoDAO->consultar());
		$resultado = $this->conexion->extraer();
		$this->nombre = $resultado[0];
		$this->apellido = $resultado[1];
		$this->correo = $resultado[2];
		$this->tarjetaprofesional = $resultado[3];
		$this->especialidad_idespecialidad = $resultado[4];
		$this->conexion->cerrar();
	}

	function buscarMedico($filtro) {
		$this->conexion->abrir();
		$this->conexion->ejecutar($this->medicoDAO->buscarMedico($filtro));
		$resultados = array();
		$i = 0;
		while (($registro = $this->conexion->extraer()) != null) {
			$resultados[$i] = new Medico($registro[0], $registro[1], $registro[2], '', '', $registro[3], $registro[4]);
			$i++;
		}
		$this->conexion->cerrar();
		return $resultados;
	}

	function consultarTodos() {
		$this->conexion->abrir();
		$this->conexion->ejecutar($this->medicoDAO->consultarTodos());
		$resultados = array();
		$i = 0;
		while (($registro = $this->conexion->extraer()) != null) {
			$resultados[$i] = new Medico($registro[0], $registro[1], $registro[2], '', $registro[3], $registro[4]);
			$i++;
		}
		$this->conexion->cerrar();
		return $resultados;
	}
}
