<?php
require_once 'logica/Cita.php';
require_once 'logica/Medico.php';
require_once 'logica/Paciente.php';
error_log("rol: " . $_GET["rol"]);
if($_GET["rol"]=="admin")
{
	$administrador = new Administrador($_SESSION['id']);
	$administrador->consultar();
	include 'presentacion/menuAdministrador.php';
}
else
{
    $medico = new Medico();
    $medico->consultar($_SESSION['id']);
	include 'presentacion/medico/menuMedico.php';
}
if (isset($_POST["crear"])) 
{
	error_log("Entra a crear cita");
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $medico = $_POST["medico"];
    $paciente = $_POST["paciente"];
    $consultorio = $_POST["consultorio"];
    $citaNueva = new Cita("", $fecha, $hora, $medico, $paciente, $consultorio);
    $citaNueva->registrar();
}
?>
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card">
                <div class="card-header bg-primary text-white">Crear Cita</div>
                <div class="card-body">
                    <?php
                    if (isset($_POST["crear"])) 
                    {
                    ?>
                    <div class="alert alert-success" role="alert">
                        Cita creada exitosamente.
                    </div>
                    <?php }?>
                    <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/Citas/CrearCita.php") . "&rol=" . $_GET["rol"] ?> method="post">
                        <div class="form-group">
                            <input type="date" name="fecha" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <input type="time" name="hora" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <input type="number" name="medico" class="form-control" placeholder="medico" required="required">
                        </div>
                        <div class="form-group">
                            <input type="number" name="paciente" class="form-control" placeholder="paciente" required="required">
                        </div>
                        <div class="form-group">
                            <input type="number" name="consultorio" class="form-control" placeholder="consultorio" required="required">
                        </div>
                        <button type="submit" name="crear" class="btn btn-primary">Crear</button>
                        <a class="btn btn-light" href="<?php echo "index.php?pid=" . base64_encode("presentacion/Citas/ConsultaCitasAdmin.php") . "&rol=" . $_GET["rol"] ?>" role="button">Volver</a>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>