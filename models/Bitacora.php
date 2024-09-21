<?php

Class Bitacora {

    private $db;

    //Acesso a la propiedad de base de datos para hacer consultas desde el padre Base.php
    public function __construct() {
        $this->db = database::conectar();
    }

    //Funcion para obtener datos de la tabla bitacora
    public function obtenerbitacora() {
        $query = $this->db->query("SELECT b.tabla,b.accion,b.fecha,u.correo as correo FROM bitacora as b, usuario as u WHERE b.id_usuario=u.id ORDER BY b.id ASC");
        return $query;
    }

}
