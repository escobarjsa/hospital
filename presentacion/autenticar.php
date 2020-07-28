<?php
$correo = $_POST["correo"];
$clave = $_POST["clave"];
$paciente = new Paciente("", "", "", $correo, $clave);
$administrador = new Administrador("", "", "", $correo, $clave);
if ($administrador->autenticar()) {
    $_SESSION['id'] = $administrador->getId();
    header("Location: index.php?pid=" . base64_encode("presentacion/sesionAdministrador.php"));
} else {
    if ($paciente->autenticar()) {
        if ($paciente->getEstado() == 0) {
            header("Location: index.php?pid=" . base64_encode("presentacion/inicio.php") . "&estado=true&nos=true");
        } else {
            $_SESSION['id'] = $paciente->getId();
            header("Location: index.php?pid=" . base64_encode("presentacion/sesionPaciente.php"));
        }
    } else {
        header("Location: index.php?pid=" . base64_encode("presentacion/inicio.php") . "&correo=true&nos=true");
    }
}
