<?php

class reporteClinicoDAO {
    private $id;
    private $fecha;
    private $diagnostico;
    private $tratamiento;
    private $observaciones;
    private $paciente;
    private $idCita;

    function reporteClinicoDAO( $id = '', $fecha = '', $diagnostico = '', $tratamiento = '', $observaciones = '', $paciente = '', $idCita = '' ) {
        $this -> id = $id;
        $this -> fecha = $fecha;
        $this -> diagnostico = $diagnostico;
        $this -> tratamiento = $tratamiento;
        $this -> observaciones = $observaciones;
        $this -> paciente = $paciente;
        $this-> idCita = $idCita;
    }

    function registrar() {
        return "INSERT INTO reporte_clinico (fecha, diagnostico, tratamiento, observaciones, paciente_idpaciente)
                VALUES ('" . $this -> fecha . "','" . $this -> diagnostico . "', '" . $this -> tratamiento . "', '" . $this -> observaciones . "', " . $this -> paciente . ')';
    }

    function consultar() {
        return "SELECT idespecialidad
                FROM especialidad
                WHERE nombre='" . $this -> nombre."'";
    }

    function consultarTodos() {
        return "SELECT idespecialidad, nombre
                FROM especialidad";
    }

    // function consultarTodosPorPaciente() {
    //      return "SELECT idreporte_clinico, fecha, diagnostico, tratamiento, observaciones
 //               FROM reporte_clinico
  //              WHERE paciente_idpaciente=".$this ->paciente.' Order by fecha';
    //  }

    function consultarTodosPorPaciente() {
        return "SELECT r.* from reporte_clinico r 
        INNER JOIN cita c on c.idCita = r.idCita 
        WHERE c.idPaciente = 1";
    }
}

?>