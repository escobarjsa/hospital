<?php
require_once 'logica/Persona.php';
require_once 'logica/Medico.php';
require_once 'logica/Cita.php';

$cita = new Cita();
$cita->consultar($_GET['idCita']);
$paciente = new Paciente($cita->getPaciente(),"","","","","","","","","");
$paciente->consultar();
$medico = new Medico();
$medico->consultar($cita->getMedico());
?>
<div class="modal-header">
    <h5 class="modal-title">Detalles Cita</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th width="20%">Fecha</th>
                <td><?php echo $cita->getFecha(); ?></td>
            </tr>
            <tr>
                <th width="20%">Hora</th>
                <td><?php echo $cita->getHora(); ?></td>
            </tr>
            <tr>
                <th width="20%">Paciente</th>
                <td><?php echo ($paciente->getnombre . " " . $paciente->getApellido()); ?></td>
            </tr>
            <tr>
                <th width="20%">Doctor</th>
                <td><?php echo ($medico->getNombre() . " " . $medico->getApellido()); ?></td>
            </tr>
            <tr>
                <th width="20%">Num Consultorio</th>
                <td><?php echo $cita->getConsultorio(); ?></td>
            </tr>
        </tbody>
    </table>
</div>