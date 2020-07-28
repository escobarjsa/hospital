	<div class="container">
		<div class="row">
			<?php include 'encabezado.php';?>
		</div>
		<div class="row">
			<div class="col-8">
				<div class="card">
					<div class="card-header bg-primary text-white">Bienvenido</div>
					<div class="card-body">
						<img src="img/inicio2.jpg" width="100%">
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header bg-primary text-white">Autenticacion</div>
					<div class="card-body">
						<?php
if (isset($_GET['correo'])) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Correo o clave incorrectos";
    echo "</div>";
} elseif (isset($_GET['estado'])) {
    echo "<div class='alert alert-danger' role='alert'>";
    echo "El usuario no esta activo aun";
    echo "</div>";
}
?>

						<form action="index.php?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>&nos=true" method="post">
							<div class="form-group">
								<input type="email" name="correo" class="form-control" placeholder="Correo" required="required">
							</div>
							<div class="form-group">
								<input type="password" name="clave" class="form-control" placeholder="Clave" required="required">
							</div>
							<button type="submit" class="btn btn-primary">Autenticar</button>
						</form>
						<a href=<?php echo "index.php?pid=" . base64_encode("presentacion/registro.php") . "&nos=true" ?>>Registrese Gratis</a>
					</div>
				</div>
			</div>
		</div>
	</div>
