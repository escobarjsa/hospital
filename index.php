<?php
session_start();
require 'logica/Persona.php';
require 'logica/Administrador.php';
require 'logica/Paciente.php';

?>

<head>
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link rel="stylesheet" href="css/normalize.css">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script
	src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/styles.css">

</head>


<body>
    <?php

if (isset($_GET["pid"])) {
    $pid = base64_decode($_GET["pid"]);
    if (isset($_GET["nos"]) || (!isset($_GET["nos"]) && (isset($_SESSION['id'])))) {
        include $pid;
    } else {
        header("Location: index.php");
    }
} else {
    include 'presentacion/inicio.php';
}

?>

	<script type="text/javascript" src="js/script.js"></script>
</body>