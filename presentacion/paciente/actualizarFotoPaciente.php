<?php
// Sources https://www.youtube.com/watch?v=2jxM7IwpiXc
#https://www.tutorialspoint.com/php/php_file_uploading.htm

$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();
$paciente = new Paciente($_GET["idPaciente"]);
$paciente->consultar();
include 'presentacion/menuAdministrador.php';

if (isset($_FILES['foto'])) {
    $errors = array();
    $extensions = array("jpeg", "jpg", "png");
    $ext_archivo = explode(".", $_FILES['foto']['name']);
    $ext_archivo = end($ext_archivo);
    if (in_array($ext_archivo, $extensions) === false) {
        $errors[] = "Extension no permitada, escoja un archivo con extension JPEG, PNG o JPG.";
    }
    if ($_FILES['foto']['size'] > 2097152) {
        $errors[] = "El archivo no debe pesar mas de 2MB";
    }
    if (empty($errors)) {
        $hora = round(microtime(true) * 1000);
        $nombreFoto = $hora . "." . $ext_archivo;
        move_uploaded_file($_FILES['foto']['tmp_name'], "img/" . $nombreFoto);
        if ($paciente->fotoExiste() != 0 && file_exists("img/" . $paciente->getFoto())) {
            unlink("img/" . $paciente->getFoto());
        }
        $paciente = new Paciente($_GET["idPaciente"], "", "", "", "", "", "", "", "", $nombreFoto);
        $paciente->actualizarFoto();
    }
}

function pre_r($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>
<div class="container">
	<div class="row">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="card">
				<div class="card-header bg-primary text-white">Actualizar Foto Paciente</div>
				<div class="card-body">
					<?php
if (isset($_POST["actualizar"])) {
    if ($_FILES['foto']['error'] == 1) {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'El archivo no debe pesar mas de 2MB. Seleccione otro.';
        echo '</div>';
    } else if ($errors) {
        echo '<div class="alert alert-danger" role="alert">';
        echo $errors[0];
        echo '</div>';
    } else {
        echo '<div class="alert alert-success" role="alert">';
        echo 'Foto del paciente actualizada exitosamente.';
        echo '</div>';
    }
}
?>
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/paciente/actualizarFotoPaciente.php") . "&idPaciente=" . $_GET["idPaciente"] ?> method="post" enctype="multipart/form-data">
						<div class="form-group">
							<input type="file" name="foto" class="form-control" placeholder="Foto" required="required">
						</div>
						<button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
						<a class="btn btn-light" href="<?php echo "index.php?pid=" . base64_encode("presentacion/paciente/consultarPaciente.php") ?>" role="button">Volver</a>
					</form>
				</div>
			</div>
		</div>

	</div>

</div>