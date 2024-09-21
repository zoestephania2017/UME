<?php

class Paciente {

    public $id;
    public $identidad;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $ocupacion;
    public $genero;
    public $estado_civil;
    public $direccion;
    public $acompanante;
    public $parentesco;
    public $telefono;
    public $Comentario;
    public $id_ciudad;
    public $id_estado;
    private $db;

    //Acesso a la propiedad de base de datos para hacer consultas desde el padre Base.php
    public function __construct() {
        $this->db = database::conectar();
    }

    function getId() {
        return $this->id;
    }

    function getIdentidad() {
        return $this->identidad;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getFecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    function getGenero() {
        return $this->genero;
    }

    function getEstado_civil() {
        return $this->estado_civil;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getAcompanante() {
        return $this->acompanante;
    }

    function getParentesco() {
        return $this->parentesco;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getComentario() {
        return $this->Comentario;
    }

    function getId_ciudad() {
        return $this->id_ciudad;
    }

    function getId_estado() {
        return $this->id_estado;
    }

    function getOcupacion() {
        return $this->ocupacion;
    }

    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    function setIdentidad($identidad) {
        $this->identidad = $this->db->real_escape_string($identidad);
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellido($apellido) {
        $this->apellido = $this->db->real_escape_string($apellido);
    }

    function setFecha_nacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $this->db->real_escape_string($fecha_nacimiento);
    }

    function setGenero($genero) {
        $this->genero = $this->db->real_escape_string($genero);
    }

    function setEstado_civil($estado_civil) {
        $this->estado_civil = $this->db->real_escape_string($estado_civil);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setAcompanante($acompanante) {
        $this->acompanante = $this->db->real_escape_string($acompanante);
    }

    function setParentesco($parentesco) {
        $this->parentesco = $this->db->real_escape_string($parentesco);
    }

    function setTelefono($telefono) {
        $this->telefono = $this->db->real_escape_string($telefono);
    }

    function setComentario($Comentario) {
        $this->Comentario = $this->db->real_escape_string($Comentario);
    }

    function setId_ciudad($id_ciudad) {
        $this->id_ciudad = $this->db->real_escape_string($id_ciudad);
    }

    function setId_estado($id_estado) {
        $this->id_estado = $this->db->real_escape_string($id_estado);
    }

    function setOcupacion($ocupacion) {
        $this->ocupacion = $this->db->real_escape_string($ocupacion);
    }

    //Funcion para obtener datos del paciente
    public function obtenerPaciente($idciudad) {
        if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2") {
            $query = $this->db->query("SELECT p.id,p.identidad,p.nombre,p.apellido,p.fecha_nacimiento,YEAR(CURDATE())-YEAR(p.fecha_nacimiento) as año,MONTH(CURDATE())-MONTH(p.fecha_nacimiento) as mes,DAY(CURDATE())-DAY(p.fecha_nacimiento) as dia, p.ocupacion,p.genero,p.estado_civil,p.direccion,p.acompanante,p.parentesco,p.telefono,p.comentario,d.id as iddepartamento, d.descripcion as departamento,p.id_ciudad as idciudad,c.descripcion as ciudad,p.id_estado, e.descripcion as estado FROM departamento as d, paciente as p,ciudad as c, estado as e WHERE c.id_departamento=d.id AND p.id_ciudad=c.id AND p.id_estado=e.id AND (p.id_estado=3 OR p.id_estado=5) ORDER BY id ASC");
        } else {
            $query = $this->db->query("SELECT p.id,p.identidad,p.nombre,p.apellido,p.fecha_nacimiento,YEAR(CURDATE())-YEAR(p.fecha_nacimiento) as año,MONTH(CURDATE())-MONTH(p.fecha_nacimiento) as mes,DAY(CURDATE())-DAY(p.fecha_nacimiento) as dia, p.ocupacion,p.genero,p.estado_civil,p.direccion,p.acompanante,p.parentesco,p.telefono,p.comentario,d.id as iddepartamento, d.descripcion as departamento,p.id_ciudad as idciudad,c.descripcion as ciudad,p.id_estado, e.descripcion as estado FROM departamento as d, paciente as p,ciudad as c, estado as e WHERE c.id_departamento=d.id AND p.id_ciudad=c.id AND p.id_estado=e.id AND (p.id_estado=3 OR p.id_estado=5) AND c.id= '$idciudad' ORDER BY id ASC  ");
        }
        return $query;
    }
    
    
        //Funcion para obtener datos de los pacientes por la ciudad buscada
    public function getPaciente($idciudad) {
            $query = $this->db->query("SELECT p.id,p.identidad,p.nombre,p.apellido,p.fecha_nacimiento,YEAR(CURDATE())-YEAR(p.fecha_nacimiento) as año,MONTH(CURDATE())-MONTH(p.fecha_nacimiento) as mes,DAY(CURDATE())-DAY(p.fecha_nacimiento) as dia, p.ocupacion,p.genero,p.estado_civil,p.direccion,p.acompanante,p.parentesco,p.telefono,p.comentario,d.id as iddepartamento, d.descripcion as departamento,p.id_ciudad as idciudad,c.descripcion as ciudad,p.id_estado, e.descripcion as estado FROM departamento as d, paciente as p,ciudad as c, estado as e WHERE c.id_departamento=d.id AND p.id_ciudad=c.id AND p.id_estado=e.id AND p.id_estado=3  AND c.id= '$idciudad' ORDER BY id ASC  ");
        return $query;
    }

    //Funcion para obtener del paciente a modificar
    public function modificar() {

        $paciente = $this->db->query("SELECT p.id,p.identidad,p.nombre,p.apellido,p.fecha_nacimiento,YEAR(CURDATE())-YEAR(p.fecha_nacimiento) as año,MONTH(CURDATE())-MONTH(p.fecha_nacimiento) as mes,DAY(CURDATE())-DAY(p.fecha_nacimiento) as dia, p.ocupacion,p.genero,p.estado_civil,p.direccion,p.acompanante,p.parentesco,p.telefono,p.comentario,d.id as iddepartamento, d.descripcion as departamento,p.id_ciudad as idciudad,c.descripcion as ciudad,p.id_estado, e.descripcion as estado FROM departamento as d, paciente as p,ciudad as c, estado as e WHERE c.id_departamento=d.id AND p.id_ciudad=c.id AND p.id_estado=e.id AND (p.id_estado=3 OR p.id_estado=5) AND p.id= '{$this->getId()}' ");

        return $paciente->fetch_object();
    }

    //Funcion para insertar datos del paciente
    public function insertarPaciente() {
        $sql = "INSERT INTO paciente VALUES(NULL,'{$this->getIdentidad()}','{$this->getNombre()}','{$this->getApellido()}','{$this->getFecha_nacimiento()}','{$this->getOcupacion()}','{$this->getGenero()}','{$this->getEstado_civil()}','{$this->getDireccion()}','{$this->getAcompanante()}','{$this->getParentesco()}','{$this->getTelefono()}','{$this->getComentario()}','{$this->getId_ciudad()}','3')";

        $insertar = $this->db->query($sql);   //ejecucion del query para insertar datos del paciente
        $resultado = false; // variable resultado instanciada en falso

        if ($insertar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //Funcion para modificar datos del paciente
    public function modificarPaciente() {
        $sql = "UPDATE paciente SET identidad = '{$this->getIdentidad()}',nombre = '{$this->getNombre()}',apellido = '{$this->getApellido()}',fecha_nacimiento = '{$this->getFecha_nacimiento()}',ocupacion = '{$this->getOcupacion()}',genero = '{$this->getGenero()}',estado_civil = '{$this->getEstado_civil()}',direccion = '{$this->getDireccion()}',acompanante = '{$this->getAcompanante()}',parentesco = '{$this->getParentesco()}',telefono = '{$this->getTelefono()}',comentario = '{$this->getComentario()}',id_ciudad = '{$this->getId_ciudad()}' WHERE id='{$this->getId()}' ";
        $modificar = $this->db->query($sql);   //ejecucion del query para insertar datos del paciente
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //funcion para eliminar el paciente
    public function eliminarPaciente() {
        $sql = "UPDATE paciente SET id_estado = '4' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para insertar datos del paciente
        
        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

}
