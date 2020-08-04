<?php
require 'persistencia/ConsultorioDAO.php';
require_once 'persistencia/Conexion.php';

class Consultorio {
    private $idconsultorio;
    private $nombre;
    private $consultorioDAO;
    private $conexion;

    function getIdconsultorio() {
        return $this->idconsultorio;
    }

    function getNombre() {
        return $this->nombre;
    }

    function Consultorio( $idconsultorio = '', $nombre = '' ) {
        $this->idconsultorio = $idconsultorio;
        $this->nombre = $nombre;
        $this->conexion = new Conexion();
        $this->consultorioDAO = new ConsultorioDAO( $idconsultorio, $nombre );
    }

    function registrar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->consultorioDAO->registrar() );
        $this->conexion->cerrar();
    }

    function actualizar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->consultorioDAO->actualizar() );
        $this->conexion->cerrar();
    }

    function consultar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->consultorioDAO->consultar() );
        $resultado = $this->conexion->extraer();
        $this->idconsultorio = $resultado[0];
        $this->nombre = $resultado[1];
        $this->conexion->cerrar();
    }

    function consultarTodos() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->consultorioDAO->consultarTodos() );
        $resultados = array();
        $i = 0;
        while ( ( $registro = $this->conexion->extraer() ) != null ) {
            $resultados[$i] = new Consultorio( $registro[0], $registro[1] );
            $i++;
        }
        $this->conexion->cerrar();
        return $resultados;
    }
}
