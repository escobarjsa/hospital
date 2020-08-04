<?php
require 'persistencia/EspecialidadDAO.php';
require_once 'persistencia/Conexion.php';

class Especialidad {
    private $idespecialidad;
    private $nombre;
    private $especialidadDAO;
    private $conexion;

    function getIdespecialidad() {
        return $this->idespecialidad;
    }

    function getNombre() {
        return $this->nombre;
    }

    function Especialidad( $idespecialidad = '', $nombre = '' ) {
        $this->idespecialidad = $idespecialidad;
        $this->nombre = $nombre;
        $this->conexion = new Conexion();
        $this->especialidadDAO = new EspecialidadDAO( $idespecialidad, $nombre );
    }

    function registrar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->especialidadDAO->registrar() );
        $this->conexion->cerrar();
    }

    function actualizar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->especialidadDAO->actualizar() );
        $this->conexion->cerrar();
    }

    function consultar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->especialidadDAO->consultar() );
        $resultado = $this->conexion->extraer();
        $this->idespecialidad = $resultado[0];
        $this->nombre = $resultado[1];
        $this->conexion->cerrar();
    }

    function consultarTodos() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->especialidadDAO->consultarTodos() );
        $resultados = array();
        $i = 0;
        while ( ( $registro = $this->conexion->extraer() ) != null ) {
            $resultados[$i] = new Especialidad( $registro[0], $registro[1] );
            $i++;
        }
        $this->conexion->cerrar();
        return $resultados;
    }
}
