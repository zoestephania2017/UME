<?php

class Reportes {

    private $db;

    //Acesso a la propiedad de base de datos para hacer consultas desde el padre Base.php
    public function __construct() {
        $this->db = database::conectar();
    }

    //Funcion para obtener los departamentos con su cantidad de atenciones 
    public function atencionesdp($dp,$finicio,$ffin) {
        if($dp==="*"){
         $query = $this->db->query("SELECT d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY d.descripcion ORDER BY totales ASC");     
        }else{
         $query = $this->db->query("SELECT d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND d.id='$dp' AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY d.descripcion ORDER BY totales ASC");       
        }
        
        
        return $query;
    }
    
    
    
        //Funcion para obtener los ciudades con su cantidad de atenciones 
    public function atencionesci($ci,$finicio,$ffin) {
        if($ci==="*"){
         $query = $this->db->query("SELECT c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY d.descripcion,c.descripcion ORDER BY totales ASC");     
        }else{
         $query = $this->db->query("SELECT c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND c.id='$ci' AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY d.descripcion,c.descripcion ORDER BY totales ASC");       
        }
        
        
        return $query;
    }
    
    
            //Funcion para obtener los ciudades con su cantidad de atenciones 
    public function atencionesce($ce,$finicio,$ffin) {
        if($ce==="*"){
         $query = $this->db->query("SELECT ce.descripcion as centro, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c, centroasistencial as ce WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.id_centro=ce.id AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY ce.descripcion,d.descripcion,c.descripcion ORDER BY totales ASC");     
        }else{
         $query = $this->db->query("SELECT ce.descripcion as centro, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c, centroasistencial as ce WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.id_centro=ce.id AND ce.id='$ce' AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY ce.descripcion,d.descripcion,c.descripcion ORDER BY totales ASC");       
        }
        
        
        return $query;
    }
    
    
    //Funcion para obtener cantidad de atenciones por ambulancia
    public function atencionesam($am,$finicio,$ffin) {
        if($am==="*"){
         $query = $this->db->query("SELECT pu.descripcion as punto,am.unidad as unidad, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c, ambulancia as am,puntoestrategico as pu WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.id_ambulancia=am.id AND am.id_punto=pu.id  AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY pu.descripcion, d.descripcion, c.descripcion,am.unidad ORDER BY totales ASC");     
        }else{
         $query = $this->db->query("SELECT pu.descripcion as punto,am.unidad as unidad, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c, ambulancia as am,puntoestrategico as pu WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.id_ambulancia=am.id AND am.id_punto=pu.id AND am.id='$am' AND a.fecha_creacion BETWEEN'$finicio' AND '$ffin' GROUP BY pu.descripcion, d.descripcion,c.descripcion,am.unidad ORDER BY totales ASC");       
        }
        
        
        return $query;
    }
    
    
    
        //Funcion para obtener cantidad de atenciones por tipo de atencion
    public function atencionesat($at,$finicio,$ffin) {
        if($at==="*"){
         $query = $this->db->query("SELECT a.atencion_brindada as atencion, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY  a.atencion_brindada ,d.descripcion,c.descripcion ORDER BY d.id ASC");     
        }else{
         $query = $this->db->query("SELECT a.atencion_brindada as atencion, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.atencion_brindada = '$at' AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY  a.atencion_brindada ,d.descripcion,c.descripcion ORDER BY d.id ASC");       
        }

        return $query;
    }
    
    
    
            //Funcion para obtener cantidad de atenciones por traslado
    public function atencionestra($tra,$finicio,$ffin) {
        if($tra==="*"){
         $query = $this->db->query("SELECT a.traslado as traslado, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY  a.traslado ,d.descripcion,c.descripcion ORDER BY d.id ASC");     
        }else{
         $query = $this->db->query("SELECT a.traslado as traslado, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.traslado = '$tra' AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY  a.traslado ,d.descripcion,c.descripcion ORDER BY d.id ASC");       
        }

        return $query;
    }
    
    
     //Funcion para obtener cantidad de atenciones por sala
    public function atencionessala($sala,$finicio,$ffin) {
        if($sala==="*"){
         $query = $this->db->query("SELECT s.descripcion as sala, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c, sala as s WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.id_sala= s.id AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY  s.descripcion ,d.descripcion,c.descripcion ORDER BY d.id ASC");     
        }else{
         $query = $this->db->query("SELECT s.descripcion as sala, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c, sala as s WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.id_sala= s.id AND s.id='$sala' AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY  s.descripcion ,d.descripcion,c.descripcion ORDER BY d.id ASC");       
        }

        return $query;
    }
    
    
         //Funcion para obtener cantidad de atenciones por diagnostico
    public function atencionesdiagnostico($diagnostico,$finicio,$ffin) {
        if($diagnostico==="*"){
         $query = $this->db->query("SELECT di.descripcion as diagnostico, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c, diagnostico as di WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.id_diagnostico= di.id AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY  di.descripcion ,d.descripcion,c.descripcion ORDER BY d.id ASC");     
        }else{
         $query = $this->db->query("SELECT di.descripcion as diagnostico, c.descripcion as ciudad ,d.descripcion as departamento ,COUNT(a.id) as totales FROM  paciente as p, atencion as a,departamento as d, ciudad as c, diagnostico as di WHERE a.id_paciente=p.id AND a.id_estado=5 AND p.id_ciudad=c.id AND c.id_departamento=d.id AND a.id_diagnostico= di.id AND di.id= '$diagnostico' AND a.fecha_creacion BETWEEN '$finicio' AND '$ffin' GROUP BY  di.descripcion ,d.descripcion,c.descripcion ORDER BY d.id ASC");       
        }

        return $query;
    }
    

}
