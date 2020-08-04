<?php

class EspecialidadDAO {

    private $idespecialidad;
    private $nombre;

    function EspecialidadDAO( $idespecialidad = '', $nombre = '' ) {
        $this -> idespecialidad = $idespecialidad ;
        $this -> nombre = $nombre;
    }

    function registrar() {
        return "insert into especialidad
                (nombre)
                values ('" . $this->nombre . "')";
    }

    function actualizar() {
        return "update especialidad set
                nombre = '" . $this -> nombre . "'
                where idespecialidad=" . $this -> id;
    }

    function consultar() {
        return "select nombre
                from especialidad
                where idespecialidad =" . $this -> id;
    }

    function consultarTodos() {
        return "select nombre
                from especialidad" ;
    }
}

?>
