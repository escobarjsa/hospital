<?php
class AdministradorDAO {
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;

    function __construct($id, $nombre, $apellido, $correo, $clave) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
    }

    function autenticar() {
        return "SELECT idadministrador
                FROM administrador
                WHERE correo = '" . $this->correo . "' and clave = md5('" . $this->clave . "')";
    }

    function consultar() {
        return "SELECT idadministrador, nombre, apellido, correo
                FROM administrador
                WHERE idadministrador = '" . $this->id . "'";
    }
}
