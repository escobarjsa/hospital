<?php

class PacienteDAO {

    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $cedula;
    private $estado;
    private $telefono;
    private $direccion;
    private $foto;

    function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $cedula = "", $estado = "", $telefono = "", $direccion = "", $foto = "") {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->cedula = $cedula;
        $this->estado = $estado;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->foto = $foto;
    }

    function registrar() {
        return "INSERT INTO paciente (nombre, apellido, correo, clave, cedula, estado)
                VALUES ('" . $this->nombre . "', '" . $this->apellido . "', '" . $this->correo . "', md5('" . $this->clave . "'), '" . $this->cedula . "', '" . $this->estado . "')";
    }

    function actualizar() {
        return "update paciente set
                nombre = '" . $this->nombre . "',
                apellido='" . $this->apellido . "',
                cedula ='" . $this->cedula . "',
                telefono='" . $this->telefono . "',
                direccion='" . $this->direccion . "'
                where idpaciente=" . $this->id;
    }

    function consultar() {
        return "SELECT nombre, apellido, correo, cedula, telefono, direccion, foto, estado
                FROM paciente
                WHERE idpaciente =" . $this->id;
    }

    function existeCorreo() {
        return "SELECT idpaciente
                FROM paciente
                WHERE correo = '" . $this->correo . "'";
    }

    function consultarTodos() {
        return "SELECT idpaciente, nombre, apellido, correo, estado, foto
                FROM paciente
                ORDER BY idpaciente";
    }

    function fotoExiste() {
        return "SELECT foto
                FROM paciente
                WHERE idpaciente = " . $this->id;
    }

    function actualizarFoto() {
        return "UPDATE paciente
                SET foto = '" . $this->foto . "'
                WHERE idpaciente = " . $this->id;
    }

    function autenticar() {
        return "SELECT idpaciente, estado
                FROM paciente
                WHERE correo = '" . $this->correo . "' and clave = md5('" . $this->clave . "')";
    }

    function actualizarEstado() {
        $est = ($this->estado == 1) ? "0" : "1";
        return "UPDATE paciente
                SET estado = " . $est .
        " WHERE idpaciente = " . $this->id;

    }

    function filtroPaciente($filtro) {
        // CONCAT hace de que se pueda hacer una consulta usando nombre y apellido al tiempo, no separado
        return "SELECT idpaciente, nombre, apellido, correo, estado, foto
				FROM paciente
				WHERE nombre LIKE '%" . $filtro . "%' OR apellido LIKE '%" . $filtro . "%' OR CONCAT(nombre, ' ', apellido) LIKE '%" . $filtro . "%'";
    }

    function obtenerCitas() {
        return 'SELECT p.idpaciente, CONCAT(p.nombre, " ", p.apellido), p.correo, p.foto, c.fecha, c.hora, CONCAT(m.nombre, " ", m.apellido), co.nombre, especialidad.nombre
				FROM paciente AS p, cita AS c, medico AS m, consultorio as co, especialidad
				WHERE c.paciente_idpaciente = p.idpaciente AND c.medico_idmedico = m.idmedico AND co.idconsultorio = c.consultorio_idconsultorio
							AND especialidad.idespecialidad = m.especialidad_idespecialidad
				ORDER BY p.idpaciente;';
    }
}
