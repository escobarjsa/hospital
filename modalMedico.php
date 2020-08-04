<?php
require_once 'logica/Persona.php';
require_once 'logica/Medico.php';

$idMedico = $_GET['idMedico'];
$medico = new Medico($idMedico);
$medico->consultar();

?>
<div class="modal-header">
    <h5 class="modal-title">Detalles Medico</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th width="20%">Nombre</th>
                <td><?php echo $medico->getNombre(); ?></td>
            </tr>
            <tr>
                <th width="20%">Apellido</th>
                <td><?php echo $medico->getApellido(); ?></td>
            </tr>
            <tr>
                <th width="20%">Correo</th>
                <td><?php echo $medico->getCorreo(); ?></td>
            </tr>
            <tr>
                <th width="20%">Tarjeta profesional</th>
                <td><?php echo $medico->getTarjetaProfesional(); ?></td>
            </tr>
            <tr>
                <th width="20%">Especialidad</th>
                <td><?php echo $medico->getEspecialidad_Idespecialidad(); ?></td>
            </tr>
        </tbody>
    </table>
</div>