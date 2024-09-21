<?php

class Ciudad {

    private $id;
    private $descripcion;
    private $id_estado;
    private $id_departamento;
    private $db;

    //Acesso a la propiedad de base de datos para hacer consultas desde el padre Base.php
    public function __construct() {
        $this->db = database::conectar();
    }

    function getId() {
        return $this->id;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getId_estado() {
        return $this->id_estado;
    }
    
    function getId_departamento() {
        return $this->id_departamento;
    }

    
    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion); //real_scape_string es para limpiar las propiedades
    }

    function setId_estado($id_estado) {
        $this->id_estado = $this->db->real_escape_string($id_estado);
    }
    
    function setId_departamento($id_departamento) {
        $this->id_departamento = $this->db->real_escape_string($id_departamento);
    }

    
    //Funcion para obtener datos de la ciudad
    public function obtenerCiudad() {
        $query = $this->db->query("SELECT c.id,c.descripcion,c.id_estado,c.id_departamento, e.descripcion as estado, d.descripcion as departamento FROM departamento as d, ciudad as c, estado as e WHERE c.id_departamento=d.id AND c.id_estado=e.id AND c.id_estado=5 ORDER BY id ASC ");
        return $query;
    }
    
    //Funcion para obtener datos de la ciudad filtrado por el departamento
    public function getCiudad($iddepartamento ) {
        $query = $this->db->query("SELECT c.id,c.descripcion,c.id_estado,c.id_departamento, e.descripcion as estado, d.descripcion as departamento FROM departamento as d, ciudad as c, estado as e WHERE c.id_departamento=d.id AND c.id_estado=e.id AND c.id_estado=5 AND c.id_departamento=$iddepartamento ORDER BY id ASC ");
        return $query;
    }
    
    
        //Funcion para obtener datos de la ciudad filtrado por la ciudad del paciente
    public function getUnaciudad($iddepartamento,$idciudad) {
        if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2") {
        $query = $this->db->query("SELECT c.id,c.descripcion,c.id_estado,c.id_departamento, e.descripcion as estado, d.descripcion as departamento FROM departamento as d, ciudad as c, estado as e WHERE c.id_departamento=d.id AND c.id_estado=e.id AND c.id_estado=5 AND c.id_departamento=$iddepartamento ORDER BY id ASC ");
         }else{
        $query = $this->db->query("SELECT c.id,c.descripcion,c.id_estado,c.id_departamento, e.descripcion as estado, d.descripcion as departamento FROM departamento as d, ciudad as c, estado as e WHERE c.id_departamento=d.id AND c.id_estado=e.id AND c.id_estado=5 AND c.id=$idciudad ORDER BY id ASC ");
         }
   
        return $query;
    }
    
    
    
    

    //Funcion para obtener del ciudad a modificar
    public function modificar() {

        $paciente = $this->db->query("SELECT * FROM ciudad WHERE id= '{$this->getId()}' ");

        return $paciente->fetch_object();
    }

    //Función para insertar la ciudad a la base de datos
    public function insertarCiudad() {
        $sql = "INSERT INTO ciudad(descripcion,id_estado,id_departamento) VALUES('{$this->getDescripcion()}','{$this->getId_estado()}','{$this->getId_departamento()}')";
        $insertar = $this->db->query($sql);
        $resultado = false;

        if ($insertar) {
            $resultado = true;
        }
        return $resultado;
    }

    //Funcion para modificar datos de la ciudad
    public function modificarCiudad() {
        $sql = "UPDATE ciudad SET descripcion = '{$this->getDescripcion()}',id_departamento = '{$this->getId_departamento()}' WHERE id='{$this->getId()}' ";
        $modificar = $this->db->query($sql);   //ejecucion del query para modificar datos de la ciudad
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //funcion para eliminar la ciudad
    public function eliminarCiudad() {
        $sql = "UPDATE ciudad SET id_estado = '4' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para eliminar datos de la ciudad

        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

}
