<?php
include 'logica/Medico.php';
$correo = $_POST["correo"];
$clave = $_POST["clave"];
$paciente = new Paciente("", "", "", $correo, $clave, "", "", "", "", "");
$administrador = new Administrador("", "", "", $correo, $clave);
error_log("correo: " . $correo . ", clave: " . $clave);
$medico = new Medico();
error_log("Fin nuevo medico");
if ($administrador->autenticar()) {
    $_SESSION['id'] = $administrador->getId();
    header("Location: index.php?pid=" . base64_encode("presentacion/sesionAdministrador.php"));
}
elseif($paciente->autenticar()) 
{
    if ($paciente->getEstado() == 0) {
        header("Location: index.php?pid=" . base64_encode("presentacion/inicio.php") . "&estado=true&nos=true");
    } else {
        $_SESSION['id'] = $paciente->getId();
        header("Location: index.php?pid=" . base64_encode("presentacion/sesionPaciente.php"));
    }   
}
elseif($medico->autenticar($correo, $clave))
{
    error_log("autenticarMedico: " . $medico->getId());
    $_SESSION['id'] = $medico->getId();
    header("Location: index.php?pid=" . base64_encode("presentacion/medico/sesionMedico.php"));
}
else
{
    header("Location: index.php?pid=" . base64_encode("presentacion/inicio.php") . "&correo=true&nos=true");
}