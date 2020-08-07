<?php
require 'persistencia/CitaDAO.php';
require_once 'persistencia/Conexion.php';

class Cita {
    private $idcita;
    private $fecha;
    private $hora;
    private $estadoCita;
    private $medico_idmedico;
    private $paciente_idpaciente;
    private $consultorio_idconsultorio;
    private $citaDAO;
    private $conexion;

    function getIdcita() {
        return $this -> idcita;
    }

    function getFecha() {
        return $this -> fecha;
    }

    function getHora() {
        return $this -> hora;
    }

    function getEstadoCita() {
        return $this -> estadoCita;
    }

    function getMedico() {
        return $this -> medico_idmedico;
    }

    function getPaciente() {
        return $this -> paciente_idpaciente;
    }

    function getConsultorio() {
        return $this -> consultorio_idconsultorio;
    }

    function Cita ( $idcita = '', $fecha = '', $hora = '', $estadoCita = '', $medico_idmedico = '', $paciente_idpaciente = '', $consultorio_idconsultorio = '' ) {
        $this -> idcita = $idcita;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this -> estadoCita = $estadoCita;
        $this -> medico_idmedico = $medico_idmedico ;
        $this -> paciente_idpaciente = $paciente_idpaciente;
        $this -> consultorio_idconsultorio = $consultorio_idconsultorio;
        $this -> conexion = new Conexion();
        $this -> citaDAO = new CitaDAO( $idcita, $fecha, $hora, $medico_idmedico, $paciente_idpaciente, $consultorio_idconsultorio );
    }

    function registrar() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> citaDAO -> registrar() );
        $this -> conexion -> cerrar();
    }

    function actualizar() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> citaDAO ->actualizar() );
        $this -> conexion -> cerrar();
    }

    function consultar() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> citaDAO -> consultar() );
        $resultado = $this -> conexion -> extraer();
        $this -> idcita = $resultado[0];
        $this -> fecha = $resultado[1];
        $this -> hora = $resultado[2];
        $this -> estadoCita = $resultado[3];
        $this -> medico_idmedico = $resultado[4];
        $this -> paciente_idpaciente = $resultado[5];
        $this -> consultorio_idconsultorio = $resultado[6];
        $this -> conexion -> cerrar();
    }

    function consultarTodos() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar( $this -> citaDAO -> consultarTodos() );
        $resultados = array();
        $i = 0;
        while( ( $registro = $this -> conexion -> extraer() ) != null ) {
            $resultados[$i] = new Cita( $registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $registro[6] );
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }

}

