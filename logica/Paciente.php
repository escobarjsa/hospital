<?php
require 'persistencia/PacienteDAO.php';
require_once 'persistencia/Conexion.php';

class Paciente extends Persona {
    private $cedula;
    private $estado;
    private $telefono;
    private $direccion;
    private $pacienteDAO;
    private $conexion;
    private $foto;

    function getEstado() {
        return $this->estado;
    }

    function getcedula() {
        return $this->cedula;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getFoto() {
        return $this->foto;
    }

    function __construct( $id = '', $nombre = '', $apellido = '', $correo = '', $clave = '', $cedula = '', $estado = '', $telefono = '', $direccion = '', $foto = '' ) {
        parent::__construct( $id, $nombre, $apellido, $correo, $clave );
        $this->cedula = $cedula;
        $this->estado = $estado;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->foto = $foto;
        $this->conexion = new Conexion();
        $this->pacienteDAO = new PacienteDAO( $id, $nombre, $apellido, $correo, $clave, $cedula, $estado, $telefono, $direccion, $foto );
    }

    function registrar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->registrar() );
        $this->conexion->cerrar();
    }

    function actualizar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->actualizar() );
        $this->conexion->cerrar();
    }

    function existeCorreo() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->existeCorreo() );
        if ( $this->conexion->numFilas() == 0 ) {
            $this->conexion->cerrar();
            return false;
        } else {
            $this->conexion->cerrar();
            return true;
        }
    }

    function consultar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->consultar() );
        $resultado = $this->conexion->extraer();
        $this->nombre = $resultado[0];
        $this->apellido = $resultado[1];
        $this->correo = $resultado[2];
        $this->cedula = $resultado[3];
        $this->telefono = $resultado[4];
        $this->direccion = $resultado[5];
        $this->foto = $resultado[6];
        $this->estado = $resultado[7];
        $this->conexion->cerrar();
    }

    function consultarTodos() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->consultarTodos() );
        $resultados = array();
        $i = 0;
        while ( ( $registro = $this->conexion->extraer() ) != null ) {
            $resultados[$i] = new Paciente( $registro[0], $registro[1], $registro[2], $registro[3], '', '', $registro[4], '', '', $registro[5] );
            $i++;
        }
        $this->conexion->cerrar();
        return $resultados;
    }

    function fotoExiste() {
        $this->conexion->abrir();

        $this->conexion->ejecutar( $this->pacienteDAO->fotoExiste() );
        if ( $this->conexion->extraer()[0] === '' || !( $this->conexion->extraer()[0] ) ) {
            $this->conexion->cerrar();
            return 0;
        } else {
            $this->conexion->ejecutar( $this->pacienteDAO->fotoExiste() );
            $resultado = $this->conexion->extraer()[0];
            $this->conexion->cerrar();
            return $resultado;
        }
    }

    function actualizarFoto() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->actualizarFoto() );
        $this->conexion->cerrar();
    }

    function autenticar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->autenticar() );
        if ( $this->conexion->numFilas() == 1 ) {
            $resultado = $this->conexion->extraer();
            $this->id = $resultado[0];
            $this->estado = $resultado[1];
            $this->conexion->cerrar();
            return true;
        } else {
            $this->conexion->cerrar();
            return false;
        }
    }

    function actualizarEstado() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->actualizarEstado() );
        $this->conexion->cerrar();
    }

    function filtroPaciente( $filtro ) {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->filtroPaciente( $filtro ) );
        $resultados = array();
        $i = 0;
        while ( ( $registro = $this->conexion->extraer() ) != null ) {
            $resultados[$i] = new Paciente( $registro[0], $registro[1], $registro[2], $registro[3], '', '', $registro[4], '', '', $registro[5] );
            $i++;
        }
        $this->conexion->cerrar();
        return $resultados;
    }

    function obtenerCitas() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->pacienteDAO->obtenerCitas() );
        $resultados = array();
        $i = 0;
        while ( ( $registro = $this->conexion->extraer() ) != null ) {
            $resultados[$i] = array( $registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $registro[6], $registro[7], $registro[8] );
            $i++;
        }
        $this->conexion->cerrar();
        return $resultados;
    }
}
