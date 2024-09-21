<?php

class Conductor {

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

    //Funcion para obtener datos del Conductor
    public function obtenerConductor() {
        $query = $this->db->query("SELECT co.id,co.identidad,co.primer_nombre,co.segundo_nombre,co.primer_apellido,co.segundo_apellido,co.genero,co.estado_civil,co.fecha_nacimiento,co.direccion,co.telefono,co.fecha_ingreso,d.id as iddepartamento,d.descripcion as departamento,c.id as idciudad,c.descripcion as ciudad, e.descripcion as estado FROM departamento as d,conductor as co, estado as e, ciudad as c WHERE c.id_departamento=d.id AND co.id_estado = e.id AND co.id_ciudad = c.id AND (co.id_estado=3 OR co.id_estado=5 ) ORDER BY co.id ASC");
        return $query;
    }

    //Funcion para obtener datos del paramedico filtrado por la ciudad
    public function getConductor($idciudad,$estado) {
        $query = $this->db->query("SELECT co.id,co.identidad,co.primer_nombre,co.segundo_nombre,co.primer_apellido,co.segundo_apellido,co.genero,co.estado_civil,co.fecha_nacimiento,co.direccion,co.telefono,co.fecha_ingreso FROM conductor as co, ciudad as c WHERE co.id_ciudad=c.id AND co.id_ciudad='$idciudad' AND co.id_estado=$estado  ORDER BY co.id ASC");
        return $query;
    }

    //Funcion para obtener del Conductor a modificar
    public function modificar() {

        $Conductor = $this->db->query("SELECT co.id,co.identidad,co.primer_nombre,co.segundo_nombre,co.primer_apellido,co.segundo_apellido,co.genero,co.estado_civil,co.fecha_nacimiento,co.direccion,co.telefono,co.fecha_ingreso,d.id as iddepartamento,d.descripcion as departamento,c.id as idciudad,c.descripcion as ciudad, e.descripcion as estado FROM departamento as d,conductor as co, estado as e, ciudad as c WHERE c.id_departamento=d.id AND co.id_estado = e.id AND co.id_ciudad = c.id AND (co.id_estado=3 OR co.id_estado=5 ) AND co.id= '{$this->getId()}' ");

        return $Conductor->fetch_object();
    }

    //Funcion para insertar datos del Conductor
    public function insertarConductor() {
        $sql = "INSERT INTO conductor VALUES(NULL,'{$this->getIdentidad()}','{$this->getPrimer_nombre()}','{$this->getSegundo_nombre()}','{$this->getPrimer_apellido()}','{$this->getSegundo_apellido()}','{$this->getFecha_nacimiento()}','{$this->getGenero()}','{$this->getEstado_civil()}','{$this->getTelefono()}','{$this->getDireccion()}','{$this->getId_ciudad()}','{$this->getId_estado()}','{$this->getFecha_ingreso()}')";

        $insertar = $this->db->query($sql);   //ejecucion del query para insertar datos del Conductor
        $resultado = false; // variable resultado instanciada en falso

        if ($insertar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //Funcion para modificar datos del Conductor
    public function modificarConductor() {
        $sql = "UPDATE conductor SET identidad = '{$this->getIdentidad()}',primer_nombre = '{$this->getPrimer_nombre()}',segundo_nombre = '{$this->getSegundo_nombre()}',primer_apellido = '{$this->getPrimer_apellido()}',segundo_apellido = '{$this->getSegundo_apellido()}',genero = '{$this->getGenero()}',estado_civil = '{$this->getEstado_civil()}',fecha_nacimiento = '{$this->getFecha_nacimiento()}',direccion = '{$this->getDireccion()}',telefono = '{$this->getTelefono()}',id_ciudad = '{$this->getId_ciudad()}',fecha_ingreso = '{$this->getFecha_ingreso()}' WHERE id='{$this->getId()}' ";
        $modificar = $this->db->query($sql);   //ejecucion del query para insertar datos del Conductor
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //funcion para eliminar el medico
    public function eliminarConductor() {
        $sql = "UPDATE conductor SET id_estado = '4' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para eliminar datos de la puntoestrategico

        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

}
