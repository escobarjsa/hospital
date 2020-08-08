<?php
require 'persistencia/reporteClinicoDAO.php';
require_once 'persistencia/Conexion.php';

class reporteClinico {
    private $id;
    private $fecha;
    private $diagnostico;
    private $tratamiento;
    private $observaciones;
    private $paciente;
    private $reporteClinicoDAO;
    private $conexion;
    private $idCita;

    /**
    * @return  <string, mixed>
    */

    public function getId() {
        return $this->id;
    }

    /**
    * @return string
    */

    public function getFecha() {
        return $this->fecha;
    }

    /**
    * @return string
    */

    public function getDiagnostico() {
        return $this->diagnostico;
    }

    /**
    * @return string
    */

    public function getTratamiento() {
        return $this->tratamiento;
    }

    /**
    * @return string
    */

    public function getObservaciones() {
        return $this->observaciones;
    }

    /**
    * @return string
    */

    public function getPaciente() {
        return $this->paciente;
    }

    /**
    * @return string
    */

    public function getIdCita() {
        return $this->idCita;
    }

    /**
    * @param Ambigous <string, mixed> $id
    */

    public function setId( $id ) {
        $this->id = $id;
    }

    /**
    * @param string $fecha
    */

    public function setFecha( $fecha ) {
        $this->fecha = $fecha;
    }

    /**
    * @param string $diagnostico
    */

    public function setDiagnostico( $diagnostico ) {
        $this->diagnostico = $diagnostico;
    }

    /**
    * @param string $tratamiento
    */

    public function setTratamiento( $tratamiento ) {
        $this->tratamiento = $tratamiento;
    }

    /**
    * @param string $observaciones
    */

    public function setObservaciones( $observaciones ) {
        $this->observaciones = $observaciones;
    }

    /**
    * @param string $paciente
    */

    public function setPaciente( $paciente ) {
        $this->paciente = $paciente;
    }

    /**
    * @param string $idCita
    */

    public function setIdCita( $idCita ) {
        $this->idCita = $idCita;
    }

    function reporteClinico( $id = '', $fecha = '', $diagnostico = '', $tratamiento = '', $observaciones = '', $paciente = '', $idCita = '' ) {
        //$paciente = '' ) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->diagnostico = $diagnostico;
        $this->tratamiento = $tratamiento;
        $this->observaciones = $observaciones;
        $this -> paciente = $paciente;
        $this-> idCita = $idCita;
        $this->conexion = new Conexion();
        $this->reporteClinicoDAO = new reporteClinicoDAO( $id, $fecha, $diagnostico, $tratamiento, $observaciones, $paciente, $idCita );
        //$paciente );
    }

    function registrar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->reporteClinicoDAO->registrar() );
        $this->conexion->cerrar();
    }

    function consultar() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->reporteClinicoDAO->consultar() );
        $resultado = $this->conexion->extraer();
        $this->id = $resultado[0];
        $this->conexion->cerrar();
    }

    function consultarTodos() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->reporteClinicoDAO->consultarTodos() );
        $resultados = array();
        $i = 0;
        while ( ( $registro = $this->conexion->extraer() ) != null ) {
            $resultados[$i] = new reporteClinico( $registro[0], $registro[1] );
            $i++;
        }
        $this->conexion->cerrar();
        return $resultados;
    }

    function consultarTodosPorPaciente() {
        $this->conexion->abrir();
        $this->conexion->ejecutar( $this->reporteClinicoDAO->consultarTodosPorPaciente() );
        $resultados = array();
        $i = 0;
        while ( ( $registro = $this->conexion->extraer() ) != null ) {
            $resultados[$i] = new reporteClinico( $registro[0], $registro[1], $registro[2], $registro[3], $registro[4] );
            $i++;
        }
        $this->conexion->cerrar();
        return $resultados;
    }
}
?>