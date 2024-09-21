<?php

class Medico {

    public $id;
    public $identidad;
    public $primer_nombre;
    public $segundo_nombre;
    public $primer_apellido;
    public $segundo_apellido;
    public $genero;
    public $estado_civil;
    public $fecha_nacimiento;
    public $direccion;
    public $telefono;
    public $id_ciudad;
    private $fecha_ingreso;
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

    function getPrimer_nombre() {
        return $this->primer_nombre;
    }

    function getSegundo_nombre() {
        return $this->segundo_nombre;
    }

    function getPrimer_apellido() {
        return $this->primer_apellido;
    }

    function getSegundo_apellido() {
        return $this->segundo_apellido;
    }

    function getGenero() {
        return $this->genero;
    }

    function getEstado_civil() {
        return $this->estado_civil;
    }

    function getFecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getId_ciudad() {
        return $this->id_ciudad;
    }

    function getFecha_ingreso() {
        return $this->fecha_ingreso;
    }

    function getId_estado() {
        return $this->id_estado;
    }

    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    function setIdentidad($identidad) {
        $this->identidad = $this->db->real_escape_string($identidad);
    }

    function setPrimer_nombre($primer_nombre) {
        $this->primer_nombre = $this->db->real_escape_string($primer_nombre);
    }

    function setSegundo_nombre($segundo_nombre) {
        $this->segundo_nombre = $this->db->real_escape_string($segundo_nombre);
    }

    function setPrimer_apellido($primer_apellido) {
        $this->primer_apellido = $this->db->real_escape_string($primer_apellido);
    }

    function setSegundo_apellido($segundo_apellido) {
        $this->segundo_apellido = $this->db->real_escape_string($segundo_apellido);
    }

    function setGenero($genero) {
        $this->genero = $this->db->real_escape_string($genero);
    }

    function setEstado_civil($estado_civil) {
        $this->estado_civil = $this->db->real_escape_string($estado_civil);
    }

    function setFecha_nacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $this->db->real_escape_string($fecha_nacimiento);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setTelefono($telefono) {
        $this->telefono = $this->db->real_escape_string($telefono);
    }

    function setId_ciudad($id_ciudad) {
        $this->id_ciudad = $this->db->real_escape_string($id_ciudad);
    }

    function setFecha_ingreso($fecha_ingreso) {
        $this->fecha_ingreso = $this->db->real_escape_string($fecha_ingreso);
    }

    function setId_estado($id_estado) {
        $this->id_estado = $this->db->real_escape_string($id_estado);
    }

    //Funcion para obtener datos del Medico
    public function obtenerMedico() {
        $query = $this->db->query("SELECT  m.id,m.identidad,m.primer_nombre,m.segundo_nombre,m.primer_apellido,m.segundo_apellido,m.genero,m.estado_civil,m.fecha_nacimiento,m.direccion,m.telefono,m.fecha_ingreso,d.id as iddepartamento,d.descripcion as departamento, c.id as idciudad,c.descripcion as ciudad, e.descripcion as estado FROM departamento as d,medico as m, estado as e, ciudad as c WHERE c.id_departamento=d.id AND m.id_estado = e.id AND m.id_ciudad = c.id AND m.id_estado=5 ORDER BY m.id ASC ");
        return $query;
    }
    
    
        //Funcion para obtener datos del medico por la ciudad buscada
    public function getMedico($idciudad) {
            $query = $this->db->query("SELECT  m.id,m.identidad,m.primer_nombre,m.segundo_nombre,m.primer_apellido,m.segundo_apellido,m.genero,m.estado_civil,m.fecha_nacimiento,m.direccion,m.telefono,m.fecha_ingreso,d.id as iddepartamento,d.descripcion as departamento, c.id as idciudad,c.descripcion as ciudad, e.descripcion as estado FROM departamento as d,medico as m, estado as e, ciudad as c WHERE c.id_departamento=d.id AND m.id_estado = e.id AND m.id_ciudad = c.id AND m.id_estado=5 AND m.id_ciudad=$idciudad ORDER BY m.id ASC ");
        return $query;
    }


    //Funcion para obtener del Medico a modificar
    public function modificar() {

        $medico = $this->db->query("SELECT  m.id,m.identidad,m.primer_nombre,m.segundo_nombre,m.primer_apellido,m.segundo_apellido,m.genero,m.estado_civil,m.fecha_nacimiento,m.direccion,m.telefono,m.fecha_ingreso,d.id as iddepartamento,d.descripcion as departamento, c.id as idciudad,c.descripcion as ciudad, e.descripcion as estado FROM departamento as d,medico as m, estado as e, ciudad as c WHERE c.id_departamento=d.id AND m.id_estado = e.id AND m.id_ciudad = c.id AND m.id_estado=5 AND m.id= '{$this->getId()}' ");

        return $medico->fetch_object();
    }

    //Funcion para insertar datos del Medico
    public function insertarMedico() {
        $sql = "INSERT INTO medico VALUES(NULL,'{$this->getIdentidad()}','{$this->getPrimer_nombre()}','{$this->getSegundo_nombre()}','{$this->getPrimer_apellido()}','{$this->getSegundo_apellido()}','{$this->getFecha_nacimiento()}','{$this->getGenero()}','{$this->getEstado_civil()}','{$this->getTelefono()}','{$this->getDireccion()}','{$this->getId_ciudad()}','{$this->getId_estado()}','{$this->getFecha_ingreso()}')";

        $insertar = $this->db->query($sql);   //ejecucion del query para insertar datos del Medico
        $resultado = false; // variable resultado instanciada en falso

        if ($insertar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //Funcion para modificar datos del Medico
    public function modificarMedico() {
        $sql = "UPDATE medico SET identidad = '{$this->getIdentidad()}',primer_nombre = '{$this->getPrimer_nombre()}',segundo_nombre = '{$this->getSegundo_nombre()}',primer_apellido = '{$this->getPrimer_apellido()}',segundo_apellido = '{$this->getSegundo_apellido()}',genero = '{$this->getGenero()}',estado_civil = '{$this->getEstado_civil()}',fecha_nacimiento = '{$this->getFecha_nacimiento()}',direccion = '{$this->getDireccion()}',telefono = '{$this->getTelefono()}',id_ciudad = '{$this->getId_ciudad()}', fecha_ingreso = '{$this->getFecha_ingreso()}' WHERE id='{$this->getId()}' ";
        $modificar = $this->db->query($sql);   //ejecucion del query para insertar datos del Medico
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //funcion para eliminar el medico
    public function eliminarMedico() {
        $sql = "UPDATE medico SET id_estado = '4' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para eliminar datos de la puntoestrategico

        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

}
