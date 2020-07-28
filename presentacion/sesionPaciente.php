<?php
$paciente = new Paciente($_SESSION['id']);
$paciente->consultar();
include 'presentacion/menuPaciente.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">Bienvenido Señor Usuario</div>
                <div class="card-body">
                    <p>Usuario: <?php echo $paciente->getNombre() . " " . $paciente->getApellido() ?></p>
                    <p>Correo: <?php echo $paciente->getCorreo(); ?></p>
                    <p>Hoy es: <?php echo date("d-M-Y"); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
