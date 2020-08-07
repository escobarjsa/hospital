<?php

class CitaDAO 
{

    function __construct()
    {
        
    }

    function registrar($fecha, $hora, $idMedico, $idPaciente, $idConsultorio) {
        return "insert into cita
                (fecha, hora, estadoCita, medico_idmedico, paciente_idpaciente, consultorio_idconsultorio)
                values ('" . $fecha . "', '" . $hora . "', '". $idMedico . ', ' . $idPaciente . ', ' . $idConsultorio . ')';
    }

    function actualizar($fecha, $hora, $idMedico, $idPaciente, $idConsultorio, $idCita) 
    {
        error_log("update cita set
        fecha = '" . $fecha . "',
        hora='" . $hora . "',
        medico_idmedico=" . $idMedico . ",
        paciente_idpaciente=" . $idPaciente . ",
        consultorio_idconsultorio=" . $idConsultorio . "
        where idcita=" . $idCita);
        return "update cita set
                fecha = '" . $fecha . "',
                hora='" . $hora . "',
                medico_idmedico=" . $idMedico . ",
                paciente_idpaciente=" . $idPaciente . ",
                consultorio_idconsultorio=" . $idConsultorio . " 
                where idcita=" . $idCita;
    }

    function consultar($id) {
        return "select fecha, hora, medico_idmedico,  paciente_idpaciente,  consultorio_idconsultorio
                from cita
                where idcita =" . $id;
    }

    function consultarTodos() {
        return "select * from cita order by fecha";
    }

    function filtroCita($filtro) {
        // CONCAT hace de que se pueda hacer una consulta usando nombre y apellido al tiempo, no separado
        return "SELECT idpaciente, nombre, apellido, correo, estado, foto
				FROM paciente
				WHERE nombre LIKE '%" . $filtro . "%' OR apellido LIKE '%" . $filtro . "%' OR CONCAT(nombre, ' ', apellido) LIKE '%" . $filtro . "%'";
    }
}

?>