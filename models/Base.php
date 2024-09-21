<?php

require_once 'config/database.php'; //llamar a la clase database donde se alamacena la configuracion de la conexion de la base de datos

class Base {

    public $db;

    public function __construct() {
        $this->db = database::conectar(); //obtiene el metodo conectar de la clase database
    }

//Funcion para obtener datos de todas las tablas
    public function obtenerdatos($tabla) {
        $query = $this->db->query("select * from $tabla ORDER BY id ASC ");
        return $query;
    }

    //funcion para cambiar el estado de una tabla
    public function cambioestado($tabla, $id) {
        $sql = "UPDATE $tabla SET id_estado = 5 WHERE id= $id ";
        $this->db->query($sql);
    }

//Funcion para obtener datos de todas las tablas filtrados por su estado 3 (pendiente)
    public function obtenerporestado($tabla) {
        $query = $this->db->query("select * from $tabla WHERE id_estado=3  ORDER BY id ASC ");
        return $query;
    }

//Funcion insertar en la bitacora
    public function insertarbitacora($tabla, $accion, $usuario) {
        $sql = "INSERT INTO bitacora(tabla,accion,id_estado,id_usuario) VALUES('$tabla','$accion',1,'$usuario')";
        $insertar = $this->db->query($sql);
        $resultado = false;

        if ($insertar) {
            $resultado = true;
        }
        return $resultado;
    }

}
