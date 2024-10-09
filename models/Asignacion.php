<?php

class Asignacion {

    public $id;
    public $id_paramedico;
    public $id_conductor;
    public $id_ambulancia;
    public $fecha_ingreso;
    public $id_estado;
    private $db;

    //Acesso a la propiedad de base de datos para hacer consultas desde el padre Base.php
    public function __construct() {
        $this->db = database::conectar();
    }

    function getId() {
        return $this->id;
    }

    function getId_paramedico() {
        return $this->id_paramedico;
    }

    function getId_conductor() {
        return $this->id_conductor;
    }

    function getId_ambulancia() {
        return $this->id_ambulancia;
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
    function setId_paramedico($id_paramedico) {
        $this->id_paramedico = $this->db->real_escape_string($id_paramedico);
    }

    function setId_conductor($id_conductor) {
        $this->id_conductor = $this->db->real_escape_string($id_conductor);
    }
    
        function setId_ambulancia($id_ambulancia) {
        $this->id_ambulancia = $this->db->real_escape_string($id_ambulancia);
    }

    function setFecha_ingreso($fecha_ingreso) {
        $this->fecha_ingreso = $this->db->real_escape_string($fecha_ingreso);
    }

    function setId_estado($id_estado) {
        $this->id_estado = $this->db->real_escape_string($id_estado);
    }


    //Funcion para obtener datos de la atencion
    public function obtenerAsignacion() {
            $query = $this->db->query("SELECT asi.id,p.id as idparamedico,p.identidad as identidadparamedico, p.primer_nombre as nombreparamedico, p.primer_apellido as apellidoparamedico,co.id as idconductor, co.identidad as identidadconductor,co.primer_nombre as nombreconductor,co.primer_apellido as apellidoconductor,a.id as idambulancia,a.unidad as unidad,d.id as iddepartamento, d.descripcion as departamento, c.id as idciudad, c.descripcion as ciudad, pu.id as idpunto, pu.descripcion as punto,asi.fecha_ingreso as fecha_ingreso  FROM departamento as d, ciudad as c,puntoestrategico as pu,asignacionambulancia as asi, paramedico as p, conductor co,ambulancia as a, estado as e WHERE c.id_departamento=d.id AND pu.id_ciudad=c.id AND a.id_punto=pu.id AND p.id_ciudad=c.id AND co.id_ciudad=c.id AND asi.id_paramedico=p.id AND asi.id_conductor=co.id AND asi.id_ambulancia=a.id AND asi.id_estado=e.id AND (asi.id_estado=3 OR asi.id_estado=5) ORDER BY asi.id ASC");
     
        return $query;
    }

    //Funcion para obtener del atencion a modificar
    public function modificar() {

        $atencion = $this->db->query("SELECT asi.id,p.id as idparamedico,p.identidad as identidadparamedico, p.primer_nombre as nombreparamedico, p.primer_apellido as apellidoparamedico,co.id as idconductor, co.identidad as identidadconductor,co.primer_nombre as nombreconductor,co.primer_apellido as apellidoconductor,a.id as idambulancia,a.unidad as unidad,d.id as iddepartamento, d.descripcion as departamento, c.id as idciudad, c.descripcion as ciudad, pu.id as idpunto, pu.descripcion as punto,asi.fecha_ingreso as fecha_ingreso FROM departamento as d, ciudad as c,puntoestrategico as pu,asignacionambulancia as asi, paramedico as p, conductor co,ambulancia as a, estado as e WHERE c.id_departamento=d.id AND pu.id_ciudad=c.id AND a.id_punto=pu.id AND p.id_ciudad=c.id AND co.id_ciudad=c.id AND asi.id_paramedico=p.id AND asi.id_conductor=co.id AND asi.id_ambulancia=a.id AND asi.id_estado=e.id AND asi.id= '{$this->getId()}' ");

        return $atencion->fetch_object();
    }

    //Funcion para insertar datos de la atencion
    public function insertarAsignacion() {
        $sql = "INSERT INTO asignacionambulancia(id,id_paramedico,id_conductor,id_ambulancia,id_estado, fecha_ingreso) VALUES(null,'{$this->getId_paramedico()}','{$this->getId_conductor()}','{$this->getId_ambulancia()}','{$this->getId_estado()}','{$this->getFecha_ingreso()}')";

        $insertar = $this->db->query($sql);   //ejecucion del query para insertar datos de la atencion
        $resultado = false; // variable resultado instanciada en falso

        if ($insertar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //Funcion para modificar datos de la atención
    public function modificarAsignacion() {
        $sql = "UPDATE asignacionambulancia SET id_paramedico = '{$this->getId_paramedico()}',id_conductor = '{$this->getId_conductor()}',id_ambulancia = '{$this->getId_ambulancia()}',fecha_ingreso = '{$this->getFecha_ingreso()}' WHERE id= '{$this->getId()}'";
        $modificar = $this->db->query($sql);   //ejecucion del query para insertar datos del atencion
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //funcion para eliminar la atencion
    public function eliminarAsignacion() {
        $sql = "UPDATE asignacionambulancia SET id_estado = '4' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para insertar datos del atencion

        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }


}
