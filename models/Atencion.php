<?php

class Atencion {

    public $id;
    public $tipo_incidente;
    public $lugar_incidente;
    public $traslado;
    public $atencion_brindada;
    public $patologia;
    public $estado;
    public $id_paciente;
    public $id_ambulancia;
    public $id_sala;
    public $id_diagnostico;
    public $id_centro;
    public $id_medico;
    public $id_usuario;
    private $db;

    //Acesso a la propiedad de base de datos para hacer consultas desde el padre Base.php
    public function __construct() {
        $this->db = database::conectar();
    }

    function getId() {
        return $this->id;
    }


    function getTipo_incidente() {
        return $this->tipo_incidente;
    }

    function getLugar_incidente() {
        return $this->lugar_incidente;
    }

    function getTraslado() {
        return $this->traslado;
    }

    function getAtencion_brindada() {
        return $this->atencion_brindada;
    }

    function getPatologia() {
        return $this->patologia;
    }

    function getEstado() {
        return $this->estado;
    }

    function getId_paciente() {
        return $this->id_paciente;
    }

    function getId_ambulancia() {
        return $this->id_ambulancia;
    }

    function getId_sala() {
        return $this->id_sala;
    }

    function getId_diagnostico() {
        return $this->id_diagnostico;
    }

    function getId_centro() {
        return $this->id_centro;
    }

    function getId_medico() {
        return $this->id_medico;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }
  

    function setTipo_incidente($tipo_incidente) {
        $this->tipo_incidente = $this->db->real_escape_string($tipo_incidente);
    }

    function setLugar_incidente($lugar_incidente) {
        $this->lugar_incidente = $this->db->real_escape_string($lugar_incidente);
    }

    function setTraslado($traslado) {
        $this->traslado = $this->db->real_escape_string($traslado);
    }

    function setAtencion_brindada($atencion_brindada) {
        $this->atencion_brindada = $this->db->real_escape_string($atencion_brindada);
    }

    function setPatologia($patologia) {
        $this->patologia = $this->db->real_escape_string($patologia);
    }

    function setEstado($estado) {
        $this->estado = $this->db->real_escape_string($estado);
    }

    function setId_paciente($id_paciente) {
        $this->id_paciente = $this->db->real_escape_string($id_paciente);
    }

    function setId_ambulancia($id_ambulancia) {
        $this->id_ambulancia = $this->db->real_escape_string($id_ambulancia);
    }

    function setId_sala($id_sala) {
        $this->id_sala = $this->db->real_escape_string($id_sala);
    }

    function setId_diagnostico($id_diagnostico) {
        $this->id_diagnostico = $this->db->real_escape_string($id_diagnostico);
    }

    function setId_medico($id_medico) {
        $this->id_medico = $this->db->real_escape_string($id_medico);
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $this->db->real_escape_string($id_usuario);
    }

    function setId_centro($id_centro) {
        $this->id_centro = $this->db->real_escape_string($id_centro);
    }



    //Funcion para obtener datos de la atencion
    public function obtenerAtencion($id_ciudad) {
        if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2") {
            $query = $this->db->query("SELECT a.id,a.tipo_incidente,a.lugar_incidente,a.traslado,a.atencion_brindada,a.patologia,a.estado,a.fecha_creacion,a.id_paciente,pu.id as idpunto, pu.descripcion as punto,a.id_ambulancia,a.id_sala,a.id_diagnostico,a.id_centro,a.id_estado,p.identidad as identidad, p.nombre as nombre, p.apellido as apellido,am.unidad as unidad,d.descripcion as diagnostico,ce.descripcion as centro,s.descripcion as sala, e.descripcion as estadoatencion,c.id as idciudad,c.descripcion as ciudad,m.identidad as identidadmedico,m.primer_nombre as nombremedico,m.primer_apellido as apellidomedico,de.id as iddepartamento, de.descripcion as departamento FROM puntoestrategico as pu, departamento as de, medico as m,atencion as a, paciente as p, ciudad as c, estado as e, ambulancia as am, sala as s, diagnostico as d, centroasistencial as ce WHERE am.id_punto=pu.id AND c.id_departamento=de.id AND a.id_medico=m.id AND a.id_paciente=p.id AND a.id_ambulancia=am.id AND a.id_sala=s.id AND a.id_centro=ce.id AND a.id_estado=e.id AND p.id_ciudad=c.id  AND a.id_diagnostico = d.id AND a.id_estado=5 ORDER BY a.id ASC");
        } else {
            $query = $this->db->query("SELECT a.id,a.tipo_incidente,a.lugar_incidente,a.traslado,a.atencion_brindada,a.patologia,a.estado,a.fecha_creacion,a.id_paciente,pu.id as idpunto, pu.descripcion as punto,a.id_ambulancia,a.id_sala,a.id_diagnostico,a.id_centro,a.id_estado,p.identidad as identidad, p.nombre as nombre, p.apellido as apellido,am.unidad as unidad,d.descripcion as diagnostico,ce.descripcion as centro,s.descripcion as sala, e.descripcion as estadoatencion,c.id as idciudad,c.descripcion as ciudad,m.identidad as identidadmedico,m.primer_nombre as nombremedico,m.primer_apellido as apellidomedico,de.id as iddepartamento, de.descripcion as departamento FROM puntoestrategico as pu, departamento as de, medico as m,atencion as a, paciente as p, ciudad as c, estado as e, ambulancia as am, sala as s, diagnostico as d, centroasistencial as ce WHERE am.id_punto=pu.id AND c.id_departamento=de.id AND a.id_medico=m.id AND a.id_paciente=p.id AND a.id_ambulancia=am.id AND a.id_sala=s.id AND a.id_centro=ce.id AND a.id_estado=e.id AND p.id_ciudad=c.id  AND a.id_diagnostico = d.id AND a.id_estado=5 AND p.id_ciudad='$id_ciudad' ORDER BY a.id ASC");
        }
        return $query;
    }

        //Funcion para obtener del atencion a modificar
    public function modificar() {

        $atencion = $this->db->query("SELECT a.id,a.tipo_incidente,a.lugar_incidente,a.traslado,a.atencion_brindada,a.patologia,a.estado,a.fecha_creacion,a.id_paciente,pu.id as idpunto, pu.descripcion as punto,a.id_ambulancia,a.id_sala,a.id_diagnostico,a.id_centro as idcentro,a.id_estado,p.identidad as identidad, p.nombre as nombre, p.apellido as apellido,am.unidad as unidad,d.descripcion as diagnostico,ce.descripcion as centro,s.descripcion as sala, e.descripcion as estadoatencion,c.id as idciudad,c.descripcion as ciudad,m.id as idmedico,m.identidad as identidadmedico,m.primer_nombre as nombremedico,m.primer_apellido as apellidomedico,de.id as iddepartamento, de.descripcion as departamento FROM puntoestrategico as pu, departamento as de, medico as m,atencion as a, paciente as p, ciudad as c, estado as e, ambulancia as am, sala as s, diagnostico as d, centroasistencial as ce WHERE am.id_punto=pu.id AND c.id_departamento=de.id AND a.id_medico=m.id AND a.id_paciente=p.id AND a.id_ambulancia=am.id AND a.id_sala=s.id AND a.id_centro=ce.id AND a.id_estado=e.id AND p.id_ciudad=c.id  AND a.id_diagnostico = d.id AND a.id_estado=5 AND a.id= '{$this->getId()}' ");

        return $atencion->fetch_object();
    }
    

    //Funcion para insertar datos de la atencion
    public function insertarAtencion() {
        $sql = "INSERT INTO atencion(tipo_incidente,lugar_incidente,traslado,atencion_brindada,patologia,estado,fecha_creacion,id_paciente,id_ambulancia,id_sala,id_diagnostico,id_centro,id_estado,id_usuario,id_medico) VALUES('{$this->getTipo_incidente()}','{$this->getLugar_incidente()}','{$this->getTraslado()}','{$this->getAtencion_brindada()}','{$this->getPatologia()}','{$this->getEstado()}',CURDATE(),'{$this->getId_paciente()}','{$this->getId_ambulancia()}','{$this->getId_sala()}','{$this->getId_diagnostico()}','{$this->getId_centro()}',5,'{$this->getId_usuario()}','{$this->getId_medico()}')";

        $insertar = $this->db->query($sql);   //ejecucion del query para insertar datos de la atencion
        $resultado = false; // variable resultado instanciada en falso

        if ($insertar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }
    
    
    
        //Funcion para modificar datos de la atención
    public function modificarAtencion() {
        $sql = "UPDATE atencion SET tipo_incidente = '{$this->getTipo_incidente()}',lugar_incidente = '{$this->getLugar_incidente()}',traslado = '{$this->getTraslado()}',atencion_brindada = '{$this->getAtencion_brindada()}',patologia = '{$this->getPatologia()}',estado = '{$this->getEstado()}',id_ambulancia = '{$this->getId_ambulancia()}',id_sala = '{$this->getId_sala()}',id_diagnostico = '{$this->getId_diagnostico()}',id_centro = '{$this->getId_centro()}',id_medico = '{$this->getId_medico()}' WHERE id='{$this->getId()}' ";
        $modificar = $this->db->query($sql);   //ejecucion del query para insertar datos del atencion
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }

    //funcion para eliminar la atencion
    public function eliminarAtencion() {
        $sql = "UPDATE atencion SET id_estado = '4' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para insertar datos del atencion
        
        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }
    
    
    //funcion para cambiar el estado del paciente a ingresado
    public function estadopaciente() {
        $paciente = $this->getId_paciente();
        $sql = "UPDATE paciente SET id_estado = 5 WHERE id= '$paciente' ";
        $this->db->query($sql);
    }

}
