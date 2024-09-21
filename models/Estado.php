<?php

class Estado {

    private $id;
    private $descripcion;
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

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion); //real_scape_string es para limpiar las propiedades
    }

    public function insertar() {
        $sql="INSERT INTO estado(descripcion) VALUES('{$this->getDescripcion()}')";
        $insertar = $this->db->query($sql);
        $resultado=false;
        
        if($insertar){
         $resultado = true;   
        }
        return $resultado;
    }
    
    

}
