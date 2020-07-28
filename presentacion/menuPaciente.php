<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand"
		href="index.php?pid=<?php echo base64_encode("presentacion/sesionPaciente.php") ?>"><i
		class="fas fa-home"></i></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">

			<li class="nav-item"><a class="nav-link" href="index.php">Salida</a>
			</li>
		</ul>
		<span class="navbar-text">
      Usuario: <?php echo $paciente->getNombre() . " " . $paciente->getApellido() ?>
    </span>
	</div>
</nav>
