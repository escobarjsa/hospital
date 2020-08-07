<?php

class CitaDAO {

    private $idcita;
    private $fecha;
    private $hora;
    private $estadoCita;
    private $medico_idmedico;
    private $paciente_idpaciente;
    private $consultorio_idconsultorio;

    function CitaDAO( $idcita = '', $fecha = '', $hora = '', $estadoCita = '', $medico_idmedico = '', $paciente_idpaciente = '', $consultorio_idconsultorio = '' ) {
        $this -> idcita = $idcita;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this -> estadoCita = $estadoCita;
        $this -> medico_idmedico = $medico_idmedico ;
        $this -> paciente_idpaciente = $paciente_idpaciente;
        $this -> consultorio_idconsultorio = $consultorio_idconsultorio;
    }

    function registrar() {
        return "insert into cita
                (fecha, hora, estadoCita, medico_idmedico, paciente_idpaciente, consultorio_idconsultorio)
                values ('" . $this->fecha . "', '" . $this->hora . "', " . $this->estadoCita . "', ". $this->medico_idmedico . ', ' . $this->paciente_idpaciente . ', ' . $this->consultorio_idconsultorio . ')';
    }

    function actualizar() {
        return "update cita set
                fecha = '" . $this -> fecha . "',
                hora='" . $this -> hora . "',
                estadoCita = '" . $this ->  estadoCita . "',
                medico_idmedico=" . $this -> medico_idmedico . ",
                paciente_idpaciente=" . $this -> paciente_idpaciente . ",
                consultorio_idconsultorio=" . $this -> consultorio_idconsultorio . ",
                where idcita=" . $this -> id;
    }

    function consultar() {
        return "select fecha, hora, estadoCita, medico_idmedico,  paciente_idpaciente,  consultorio_idconsultorio
                from cita
                where idcita =" . $this -> id;
    }

    function consultarTodos() {
        return "select idcita, fecha, hora, estadoCita, medico.nombre,  paciente.nombre,  consultorio.nombre
                from cita,medico,paciente,consultorio
                where medico.idmedico= medico_idmedico and paciente.idpaciente= paciente_idpaciente and consultorio.idconsultorio= consultorio_idconsultorio
                order by fecha";
    }
}

?>