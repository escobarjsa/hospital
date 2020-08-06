<?php
include 'logica/Medico.php';
$medico = new Medico();
$medico->consultar($_SESSION['id']);
include 'presentacion/medico/menuMedico.php';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Bienvenido</div>
                <div class="card-body">
                    <p>Medico <?php echo $medico->getEspecialidad_Idespecialidad() . " : " . $medico->getNombre() . " " . $medico->getApellido() ?></p>
                    <p>Correo: <?php echo $medico->getCorreo(); ?></p>
                    <p>Hoy es: <?php echo date("d-M-Y"); ?></p>
                </div>
            </div>
        </div>
        <?php
/*$solicitud = new Solicitud("", "", "", $_SESSION["id"]);
$solicitudes = $solicitud->consultarSolicitudes();
if (count($solicitudes) != 0) {
	echo "<div class='col-6 mt-4'>
               <article class='message is-link'>
                <div class='message-header'>
                <p>Notificacion</p>

                 </div>
                <div class='message-body'>
                        Posees " . count($solicitudes) . " solicitudes de " . ($medico->getEspecialidad_Idespecialidad() == "General" ? "revison" : "tratamiento") . " en espera
                </div>
            </article>
            </div>";
}*/

?>
    </div>
</div>
