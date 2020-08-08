<?php
require_once 'logica/Medico.php';
require_once 'logica/Paciente.php';
$cita = new Cita("","","","","","");
/*if (isset($_POST["filtro"])) {
    $filtro = $_POST["filtro"];
    $citas = $cita->filtro($filtro);

} else {*/
    $citas = $cita->consultarTodos();
//}

?>
<div class="card" id="table">
    <div class="card-header bg-primary text-white">Consultar Citas</div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Medico</th>
                <th scope="col">Paciente</th>
                <th scope="col">Consultorio</th>
                <th scope="col">Servicios</th>
            </tr>
            </thead>
            <tbody>
            <?php
foreach ($citas as $c) 
{
    $medico = new Medico();
    $medico->consultar($c->getMedico());
    $paciente = new Paciente($c->getPaciente(),"","","","","","","","","");
    $paciente->consultar();

    echo "<tr id='pac" . $c->getIdCita() . "'>";
    echo "<td>" . $c->getIdCita() . "</td>";
    echo "<td>" . $c->getFecha() . "</td>";
    echo "<td>" . $c->getHora() . "</td>";
    echo "<td>" . $medico->getNombre() . " " . $medico->getApellido() . "</td>";
    echo "<td>" . $paciente->getNombre() . " " . $paciente->getApellido() . "</td>";
    echo "<td>" . $c->getConsultorio() . "</td>";
    // Se codifica la url del modal para evitar mostrarla y se asegura la url, en la pagina del modal toca decodificar idCita para que el servidor lo pueda leer
    echo "<td>" . "<a href='indexAjax.php?pid=" . base64_encode("modalCita.php") . "&idCita =" . base64_encode($c->getIdCita()) . "' data-toggle='modal' data-target='#modalCita' ><span class='fas fa-eye' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Ver Detalles' ></span> </a>
								<a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/Citas/actualizarCita.php") . "&idCita=" . $c->getIdCita() . "&rol=" . $_GET["rol"] . "' data-toggle='tooltip' data-placement='top' title='Actualizar'> </a>";
    echo "</tr>";
}
echo "<tr><td colspan='9'>" . count($citas) . " registros encontrados</td></tr>";


    echo "</tbody>";
    echo "</table>";
        echo "<a class='btn btn-outline-success' href='index.php?pid=" . base64_encode("presentacion/Citas/CrearCita.php") . "&rol=" . $_GET["rol"] . "' role='button'>Crear</a>";
         if (count($citas) > 0 && isset($filtro)) {?>

            <form action="crearPdf.php" method="POST" target="_blank">
                <input type="hidden" name="filtro" value="<?php echo $_POST["filtro"]; ?>">
                <button class="btn btn-info" type="submit">Exportar resultado como PDF</button>
            </form>

                    <!--            <a class="btn btn-info" id="export"-->
            <!--               href="crearPdf.php?filtro=--><?php //echo $_POST["filtro"];?><!--" target="_blank">Exportar-->
            <!--                resultado como PDF</a>-->
        <?php }?>
    </div>

</div>
