<?php

require 'logica/Paciente.php';

//Instanciamos la clase paciente
$paciente = new paciente();

//Capturamos los datos del formulario
$cedula = $_POST['cedula'];

$registro = $paciente->leer_historial( $cedula );

?>
<!doctype html>
<html>
<head>
<meta charset = 'utf-8'>
<title>Sistema Medico</title>
<link href = 'css/estilo.css' rel = 'stylesheet' type = 'text/css'>
<link href = 'SpryAssets/SpryMenuBarHorizontal.css' rel = 'stylesheet' type = 'text/css'>
<script src = 'SpryAssets/SpryMenuBar.js' type = 'text/javascript'></script>
</head>

<body>

<p>&nbsp;
</p>
<div id = 'contenido'>
<h2>Historial y Examenes Medicos</h2>
<h3>&nbsp;
</h3>
<?php
if ( $registro )
{
    echo '<p>Historial: ' . $registro['historial'] . '<p>';
    echo '<p>Examenes: ' . $registro['examenes'] . '<p>';

}
?>
</div>
<div id = 'barra-lateral'>
<p align = 'center'>&nbsp;
</p>
<p align = 'center'>&nbsp;
</p>
<p align = 'center'>&nbsp;
</p>
<p>&nbsp;
</p>

</html>