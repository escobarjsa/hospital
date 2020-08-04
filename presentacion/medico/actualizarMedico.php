<?php
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();
$medico = new Medico ($_GET["idMedico"]);
$medico->consultar();
if (isset($_POST["actualizar"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $espe = new Especialidad("",$_POST["especialidad"]);
    $espe->consultar();
    $medico = new Medico($_GET["idMedico"], $nombre, $apellido, "", "", $espe->getId());
    $medico->actualizar();
    $medico->consultar();
}

$especialidad = new Especialidad();
$especialidades = $especialidad ->consultarTodos();

include 'presentacion/administrador/menuAdministrador.php';
?>
<div class="container">
	<div class="row mt-4">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="card">
				<div class="card-header bg-primary text-white">Actualizar Medico</div>
				<div class="card-body">
						<?php
    if (isset($_POST["actualizar"])) {
        ?>
						<div class="alert alert-success" role="alert">Medico actualizado
						exitosamente.</div>						
						<?php } ?>
						<form
						action=<?php echo "index.php?pid=" . base64_encode("presentacion/medico/actualizarMedico.php")."&idMedico=".$_GET["idMedico"] ?>
						method="post">
						<div class="form-group">
							<input type="text" name="nombre" class="form-control"
								placeholder="Nombre" required="required"
								value="<?php echo $medico->getNombre(); ?>">
						</div>
						<div class="form-group">
							<input type="text" name="apellido" class="form-control"
								placeholder="apellido" required="required"
								value="<?php echo $medico->getApellido(); ?>">
						</div>
						<div class="form-group">
							<div class="select is-rounded">
								<select name="especialidad" required="required">
									<option><?php echo $medico->getEspecialidad_Idespecialidad()()?></option>
									<?php 
									foreach ($especialidades as $e){
									    if($e->getNombre()!=$medico->getEspecialigetEspecialidad_Idespecialidad(){
									        echo "<option>".$e->getNombre()." </option>";
									    }									 								   
									}									
									?>
									<option> </option>
								</select>
							</div>
						</div>
						<button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>