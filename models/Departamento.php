<?php

class Departamento {

    private $id;
    private $descripcion;
    private $id_estado;
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

        
    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion); //real_scape_string es para limpiar las propiedades
    }
    
    function setId_estado($id_estado) {
        $this->id_estado = $this->db->real_escape_string($id_estado);
    }
    
    

    //Funcion para obtener datos de la departamento
    public function obtenerDepartamento() {
        $query = $this->db->query("SELECT d.id,d.descripcion,d.id_estado,e.descripcion as estado FROM departamento as d, estado as e WHERE d.id_estado=e.id AND d.id_estado=5 ORDER BY id ASC ");
        return $query;
    }
    
    
    
        //Funcion para obtener datos de la departamento
    public function getdepartamento($iddepartamento) {
        if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2") {
        $query = $this->db->query("SELECT d.id,d.descripcion,d.id_estado,e.descripcion as estado FROM departamento as d, estado as e WHERE d.id_estado=e.id AND d.id_estado=5 ORDER BY id ASC ");
        }else{  
            $query = $this->db->query("SELECT d.id,d.descripcion,d.id_estado,e.descripcion as estado FROM departamento as d, estado as e WHERE d.id_estado=e.id AND d.id_estado=5 AND d.id= $iddepartamento ORDER BY id ASC ");
        }
        return $query;
        
    }
    
    
     //Funcion para obtener del departamento a modificar
    public function modificar() {

        $paciente = $this->db->query("SELECT * FROM departamento WHERE id= '{$this->getId()}' ");

        return $paciente->fetch_object();
    }
    
    
    
    //Función para insertar la departamento a la base de datos
    public function insertarDepartamento() {
        $sql="INSERT INTO departamento(descripcion,id_estado) VALUES('{$this->getDescripcion()}','{$this->getId_estado()}')";
        $insertar = $this->db->query($sql);
        $resultado=false;
        
        if($insertar){
         $resultado = true;   
        }
        return $resultado;
    }
    
 
    
     //Funcion para modificar datos de la departamento
    public function modificarDepartamento() {
        $sql = "UPDATE departamento SET descripcion = '{$this->getDescripcion()}' WHERE id='{$this->getId()}' ";
        $modificar = $this->db->query($sql);   //ejecucion del query para modificar datos de la departamento
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //funcion para eliminar la departamento
    public function eliminarDepartamento() {
        $sql = "UPDATE departamento SET id_estado = '4' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para eliminar datos de la departamento
        
        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }
    
    

}
