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
                <th width="20%">Foto</th>
                <?php
echo "<td>" . (($medico->getFoto() !== "" && file_exists("img/" . $medico->getFoto() . "") && $medico->getFoto()) ? "<img src='img/" . $medico->getFoto() . "' width='300px'/>" :
    "<i class='fas fa-user-tie fa-3x'></i>") . "</td>";
?>
            </tr>
            <tr>
                <th width="20%">Cedula</th>
                <td><?php echo $medico->getCedula(); ?></td>
            </tr>
            <tr>
                <th width="20%">Correo</th>
                <td><?php echo $medico->getCorreo(); ?></td>
            </tr>
            <tr>
                <th width="20%">Direccion</th>
                <td><?php echo $medico->getDireccion(); ?></td>
            </tr>
            <tr>
                <th width="20%">Telefono</th>
                <td><?php echo $medico->getTelefono(); ?></td>
            </tr>
            <tr>
                <th width="20%">Estado</th>
                <td><?php echo (($medico->getEstado() == 1) ? "<i class='fas fa-check-circle fa-2x text-success'></i>" : "<i class='fas fa-times-circle fa-2x   text-danger'></i>"); ?></td>
            </tr>
        </tbody>
    </table>
</div>