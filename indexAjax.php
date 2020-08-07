<?php
# session variables are not passed individually to each new page, instead they are retrieved from the session we open at the beginning of each page (session_start()).
session_start();
require 'logica/Persona.php';
require 'logica/Administrador.php';
require 'logica/Paciente.php';
require 'logica/Cita.php';
$pid = base64_decode($_GET["pid"]);
if ($_SESSION['id'] != "") {
    include $pid;
} else {
    header("Location: index.php");
}
?>


<script src="js/script.js"></script>
<script>console.log("id: <?php echo $_SESSION["id"]; ?>")</script>