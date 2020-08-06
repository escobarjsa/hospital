<<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand"
		href="index.php"><i
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
            Medico <?php echo $medico->getEspecialidad_Idespecialidad() . " : " . $medico->getNombre() . " " . $medico->getApellido() ?> </span>
  </div>
</nav>
<div class="row">
  <div class="col-2">
    <div class="card">
      <div class="card-body">

        <aside class="menu">
          <p class="menu-label">Consultar</p>
          <ul class="menu-list">
            <!--
					//<li><a href=<?php echo "index.php?pid=" . base64_encode("presentacion/mascota/solicitudesMedico.php") ?>>Solicitudes Pendientes</a></li>
          <li><a href=<?php echo "index.php?pid=" . base64_encode("presentacion/mascota/historialMedico.php") ?>>Historial Solicitudes</a></li>
-->
          </ul>
        </aside>
      </div>
    </div>
  </div>