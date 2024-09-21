<?php

class Inicio {

    public $db;

    public function __construct() {
        $this->db = database::conectar(); //obtiene el metodo conectar de la clase database
    }

    //Funcion para contar las atenciones por ciudad
    public function contarciudad($ciudad) {
        $query = $this->db->query("SELECT COUNT(a.id) as porciudad  FROM  paciente as p, atencion as a, ciudad as c WHERE a.id_paciente=p.id AND p.id_ciudad=c.id AND a.id_estado=5 AND c.id = '$ciudad'");
        return $query;
    }

    //Funcion para contar las atenciones que ha registrado el usuario logeado
    public function contarusuario($usuario) {
        $query = $this->db->query("SELECT COUNT(a.id) as porusuario  FROM  paciente as p, atencion as a, ciudad as c WHERE a.id_paciente=p.id AND p.id_ciudad=c.id AND a.id_estado=5 AND id_usuario='$usuario'");
        return $query;
    }

    //Funcion para contar las atenciones que ha registrado el usuario logeado
    public function totalatenciones() {
        $query = $this->db->query("SELECT COUNT(a.id) as totalatenciones  FROM  paciente as p, atencion as a, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id");
        return $query;
    }

    //Funcion para contar las atenciones por su estado
    public function atencionesporestado() {
        $query = $this->db->query("SELECT estado, COUNT(id) as porestado FROM atencion WHERE  id_estado=5 GROUP BY estado");
        return $query;
    }
    
    
    
         //Funcion para contar las atenciones de todas los departamentos
    public function totaldepartamentos() {
        $query = $this->db->query("SELECT d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id GROUP BY d.descripcion");
        return $query;
    }
    
    
     //Funcion para contar las atenciones de todas las ciudades
    public function totalciudades() {
        $query = $this->db->query("SELECT c.descripcion as ciudad ,COUNT(a.id) as totales FROM  paciente as p, atencion as a, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id GROUP BY c.descripcion ORDER BY totales ASC ");
        return $query;
    }
    
    
         //Funcion para contar las atenciones por genero
    public function totalgenero() {
        $query = $this->db->query("SELECT p.genero as genero ,COUNT(a.id) as totales FROM  paciente as p, atencion as a, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id GROUP BY p.genero");
        return $query;
    }
    
    
    //Funcion para contar las atenciones por genero
    public function totaltraslado() {
        $query = $this->db->query("SELECT a.traslado as traslado ,COUNT(a.id) as totales FROM  paciente as p, atencion as a, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id GROUP BY a.traslado");
        return $query;
    }
    

}
