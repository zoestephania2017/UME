<?php

class PuntoEstrategico {

    private $id;
    private $descripcion;
    private $id_ciudad;
    private $id_estado;
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
    
    function getId_ciudad() {
        return $this->id_ciudad;
    }
        
    function getId_estado() {
        return $this->id_estado;
    }

        
    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion); //real_scape_string es para limpiar las propiedades
    }
    
        function setId_ciudad($id_ciudad) {
        $this->id_ciudad = $this->db->real_escape_string($id_ciudad);
    }

        
    function setId_estado($id_estado) {
        $this->id_estado = $this->db->real_escape_string($id_estado);
    }
    
    

    
    //Funcion para obtener datos de la puntoestrategico
    public function obtenerPuntoEstrategico() {
        $query = $this->db->query("SELECT p.id,p.descripcion,p.id_estado,e.descripcion as estado,p.id_ciudad as id_ciudad,ci.descripcion as ciudad, ci.id_departamento as iddepartamento, d.descripcion as departamento FROM departamento as d, puntoestrategico as p, estado as e, ciudad as ci WHERE ci.id_departamento=d.id AND ci.id=p.id_ciudad AND p.id_estado=e.id AND p.id_estado=5 ORDER BY id ASC ");
        return $query;
    }
    
        //Funcion para obtener datos de la puntoestrategico
    public function getPunto($ciudad) {
        $query = $this->db->query("SELECT p.id,p.descripcion,p.id_estado,e.descripcion as estado,p.id_ciudad as id_ciudad,ci.descripcion as ciudad, ci.id_departamento as iddepartamento, d.descripcion as departamento FROM departamento as d, puntoestrategico as p, estado as e, ciudad as ci WHERE ci.id_departamento=d.id AND ci.id=p.id_ciudad AND p.id_estado=e.id AND p.id_estado=5 AND p.id_ciudad=$ciudad ORDER BY id ASC ");
        return $query;
    }
    

    
        //Funcion para obtener del puntoestrategico a modificar
    public function modificar() {

        $punto = $this->db->query("SELECT p.id,p.descripcion,p.id_estado,e.descripcion as estado,p.id_ciudad as id_ciudad,ci.descripcion as ciudad, ci.id_departamento as iddepartamento, d.descripcion as departamento FROM departamento as d, puntoestrategico as p, estado as e, ciudad as ci WHERE ci.id_departamento=d.id AND ci.id=p.id_ciudad AND p.id_estado=e.id AND p.id_estado=5 AND p.id= '{$this->getId()}' ");

        return $punto->fetch_object();
    }
    
    
    
    //Función para insertar la puntoestrategico a la base de datos
    public function insertarPuntoEstrategico() {
        $sql="INSERT INTO puntoestrategico(descripcion,id_estado,id_ciudad) VALUES('{$this->getDescripcion()}','{$this->getId_estado()}','{$this->getId_ciudad()}')";
        $insertar = $this->db->query($sql);
        $resultado=false;
        
        if($insertar){
         $resultado = true;   
        }
        return $resultado;
    }
    
 
    
     //Funcion para modificar datos de la puntoestrategico
    public function modificarPuntoEstrategico() {
        $sql = "UPDATE puntoestrategico SET descripcion = '{$this->getDescripcion()}',id_ciudad = '{$this->getId_ciudad()}' WHERE id='{$this->getId()}' ";
        $modificar = $this->db->query($sql);   //ejecucion del query para modificar datos de la puntoestrategico
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //funcion para eliminar la puntoestrategico
    public function eliminarPuntoEstrategico() {
        $sql = "UPDATE puntoestrategico SET id_estado = '4' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para eliminar datos de la puntoestrategico
        
        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }
    
    

}
