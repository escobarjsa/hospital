<?php
require_once 'logica/Persona.php';
require_once 'logica/Paciente.php';

$idPaciente = $_GET['aWRQYWNpZW50'];
$paciente = new Paciente($idPaciente,"","","","","","","","","");
$paciente->consultar();

?>
<div class="modal-header">
    <h5 class="modal-title">Detalles Paciente</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th width="20%">Nombre</th>
                <td><?php echo $paciente->getNombre(); ?></td>
            </tr>
            <tr>
                <th width="20%">Apellido</th>
                <td><?php echo $paciente->getApellido(); ?></td>
            </tr>
            <tr>
                <th width="20%">Foto</th>
                <?php
echo "<td>" . (($paciente->getFoto() !== "" && file_exists("img/" . $paciente->getFoto() . "") && $paciente->getFoto()) ? "<img src='img/" . $paciente->getFoto() . "' width='300px'/>" :
    "<i class='fas fa-user-tie fa-3x'></i>") . "</td>";
?>
            </tr>
            <tr>
                <th width="20%">Cedula</th>
                <td><?php echo $paciente->getCedula(); ?></td>
            </tr>
            <tr>
                <th width="20%">Correo</th>
                <td><?php echo $paciente->getCorreo(); ?></td>
            </tr>
            <tr>
                <th width="20%">Direccion</th>
                <td><?php echo $paciente->getDireccion(); ?></td>
            </tr>
            <tr>
                <th width="20%">Telefono</th>
                <td><?php echo $paciente->getTelefono(); ?></td>
            </tr>
            <tr>
                <th width="20%">Estado</th>
                <td><?php echo (($paciente->getEstado() == 1) ? "<i class='fas fa-check-circle fa-2x text-success'></i>" : "<i class='fas fa-times-circle fa-2x   text-danger'></i>"); ?></td>
            </tr>
        </tbody>
    </table>
</div>