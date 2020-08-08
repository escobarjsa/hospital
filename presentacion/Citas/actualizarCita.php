<?php
require_once 'logica/Cita.php';
require_once 'logica/Medico.php';
require_once 'logica/Paciente.php';
if($_GET["rol"]=="admin")
{
	$administrador = new Administrador($_SESSION['id']);
	$administrador->consultar();
	include 'presentacion/menuAdministrador.php';
}
else
{
	include 'presentacion/medico/menuMedico.php';
}

$cita = new Cita($_GET["idCita"],"","","","","","");
$cita->consultar();
$paciente = new Paciente($cita->getPaciente(),"","","","","","","","","");
$paciente->consultar();
$medico = new Medico();
$medico->consultar($cita->getMedico());
if (isset($_POST["actualizar"])) 
{
	error_log("Entra a actualizar, idConsultorio: " . $_POST["consultorio"]);
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $medico = $_POST["medico"];
    $paciente = $_POST["paciente"];
    $consultorio = $_POST["consultorio"];
    $citaNueva = new Cita($cita->getIdcita(), $fecha, $hora, $medico, $paciente, $consultorio);
    $citaNueva->actualizar();
}
?>
	<div class="container">
		<div class="row">
			<div class="col-3"></div>
			<div class="col-6">
				<div class="card">
					<div class="card-header bg-primary text-white">Actualizar Cita</div>
					<div class="card-body">
						<?php
                        if (isset($_POST["actualizar"])) 
                        {
                        ?>
						<div class="alert alert-success" role="alert">
							Cita actualizada exitosamente.
						</div>
                        <?php }?>
						<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/Citas/actualizarCita.php") . "&idCita=" . $_GET["idCita"] ?> method="post">
							<div class="form-group">
								<input type="date" name="fecha" class="form-control" required="required" value="<?php echo $cita->getFecha(); ?>">
							</div>
							<div class="form-group">
								<input type="time" name="hora" class="form-control" required="required" value="<?php echo $cita->getHora(); ?>">
							</div>
							<div class="form-group">
								<input type="number" name="medico" class="form-control" placeholder="medico" required="required" value="<?php echo $cita->getMedico(); ?>">
							</div>
							<div class="form-group">
								<input type="number" name="paciente" class="form-control" placeholder="paciente" required="required" value="<?php echo $cita->getPaciente(); ?>">
							</div>
							<div class="form-group">
								<input type="number" name="consultorio" class="form-control" placeholder="consultorio" required="required" value="<?php echo $cita->getConsultorio(); ?>">
							</div>
							<button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
							<a class="btn btn-light" href="<?php echo "index.php?pid=" . base64_encode("presentacion/Citas/ConsultaCitasAdmin.php") . "&rol=" . $_GET["rol"] ?>" role="button">Volver</a>
						</form>
					</div>
				</div>
			</div>

		</div>

	</div>