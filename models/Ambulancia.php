<?php

class Ambulancia {

    private $id;
    private $descripcion;
    private $id_punto;
    private $id_estado;
    private $fecha_ingreso;
    private $db;

    
    //Acesso a la propiedad de base de datos para hacer consultas desde el padre Base.php
    public function __construct() {
        $this->db= database::conectar();
    }

    function getId() {
        return $this->id;
    }

    function getDescripcion() {
        return $this->descripcion;
    }
    
    function getId_punto() {
        return $this->id_punto;
    }
        
    function getId_estado() {
        return $this->id_estado;
    }
    
        function getFecha_ingreso() {
        return $this->fecha_ingreso;
    }


        
    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion); //real_scape_string es para limpiar las propiedades
    }
    
        function setId_punto($id_punto) {
        $this->id_punto = $this->db->real_escape_string($id_punto);
    }

        
    function setId_estado($id_estado) {
        $this->id_estado = $this->db->real_escape_string($id_estado);
    }
    
        function setFecha_ingreso($fecha_ingreso) {
        $this->fecha_ingreso = $this->db->real_escape_string($fecha_ingreso);
    }

    //Funcion para obtener datos de la ambulancia
    public function obtenerAmbulancia() {
        $query = $this->db->query("SELECT a.id,a.unidad,a.id_estado,a.fecha_ingreso,c.id as idciudad,c.descripcion as ciudad,d.id as iddepartamento, d.descripcion as departamento, e.descripcion as estado,a.id_punto as id_punto,p.descripcion as puntoestrategico FROM departamento as d, ciudad as c, ambulancia as a, estado as e, puntoestrategico as p WHERE d.id=c.id_departamento AND p.id_ciudad=c.id AND p.id=a.id_punto AND a.id_estado=e.id AND (a.id_estado=5 OR a.id_estado=3) ORDER BY a.id ASC ");
        return $query;
    }
    
    //Funcion para obtener datos de la ambulancia por la ciudad buscada
    public function getAmbulancia($idpunto,$estado) {
            $query = $this->db->query("SELECT a.id as id,a.unidad as unidad,a.id_estado,a.fecha_ingreso,c.id as idciudad,c.descripcion as ciudad,d.id as iddepartamento, d.descripcion as departamento, e.descripcion as estado,a.id_punto as id_punto,p.descripcion as puntoestrategico FROM departamento as d, ciudad as c, ambulancia as a, estado as e, puntoestrategico as p WHERE d.id=c.id_departamento AND p.id_ciudad=c.id AND p.id=a.id_punto AND a.id_estado=e.id AND a.id_estado=$estado AND p.id= '$idpunto' ORDER BY a.id ASC  ");
        return $query;
    }

    
    
        //Funcion para obtener del ambulancia a modificar
    public function modificar() {

        $paciente = $this->db->query("SELECT a.id,a.unidad,a.id_estado,a.fecha_ingreso,c.id as idciudad,c.descripcion as ciudad,d.id as iddepartamento, d.descripcion as departamento, e.descripcion as estado,a.id_punto as id_punto,p.descripcion as puntoestrategico FROM departamento as d, ciudad as c, ambulancia as a, estado as e, puntoestrategico as p WHERE d.id=c.id_departamento AND p.id_ciudad=c.id AND p.id=a.id_punto AND a.id_estado=e.id AND (a.id_estado=5 OR a.id_estado=3) AND a.id= '{$this->getId()}' ");

        return $paciente->fetch_object();
    }
    
    
    
    //Función para insertar la ambulancia a la base de datos
    public function insertarAmbulancia() {
        $sql="INSERT INTO ambulancia(unidad,id_estado,id_punto,fecha_ingreso) VALUES('{$this->getDescripcion()}','{$this->getId_estado()}','{$this->getId_punto()}','{$this->getFecha_ingreso()}')";
        $insertar = $this->db->query($sql);
        $resultado=false;
        
        if($insertar){
         $resultado = true;   
        }
        return $resultado;
    }
    
 
    
     //Funcion para modificar datos de la ambulancia
    public function modificarAmbulancia() {
        $sql = "UPDATE ambulancia SET unidad = '{$this->getDescripcion()}',id_punto = '{$this->getId_punto()}',fecha_ingreso = '{$this->getFecha_ingreso()}' WHERE id='{$this->getId()}' ";
        $modificar = $this->db->query($sql);   //ejecucion del query para modificar datos de la ambulancia
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //funcion para eliminar la ambulancia
    public function eliminarAmbulancia() {
        $sql = "UPDATE ambulancia SET id_estado = '4' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para eliminar datos de la ambulancia
        
        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }
    
    

}
