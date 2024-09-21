<?php

class Usuario {

    public $id;
    public $identidad;
    public $primer_nombre;
    public $segundo_nombre;
    public $primer_apellido;
    public $segundo_apellido;
    public $genero;
    public $estado_civil;
    public $fecha_nacimiento;
    public $direccion;
    public $telefono;
    public $correo;
    public $contrasena;
    public $id_ciudad;
    public $fecha_ingreso;
    public $id_rol;
    public $id_estado;
    private $db;

    //Acesso a la propiedad de base de datos para hacer consultas desde el padre Base.php
    public function __construct() {
        $this->db = database::conectar();
    }

    
    function getId() {
        return $this->id;
    }

    function getIdentidad() {
        return $this->identidad;
    }

    function getPrimer_nombre() {
        return $this->primer_nombre;
    }

    function getSegundo_nombre() {
        return $this->segundo_nombre;
    }

    function getPrimer_apellido() {
        return $this->primer_apellido;
    }

    function getSegundo_apellido() {
        return $this->segundo_apellido;
    }

    function getGenero() {
        return $this->genero;
    }

    function getEstado_civil() {
        return $this->estado_civil;
    }

    function getFecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getContrasena() {
        return password_hash($this->db->real_escape_string($this->contrasena), PASSWORD_BCRYPT, ['cost' => '10']);
    }

    function getId_ciudad() {
        return $this->id_ciudad;
    }

    function getId_rol() {
        return $this->id_rol;
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

    
    function setIdentidad($identidad) {
        $this->identidad = $this->db->real_escape_string($identidad);
    }

    function setPrimer_nombre($primer_nombre) {
        $this->primer_nombre = $this->db->real_escape_string($primer_nombre);
    }

    function setSegundo_nombre($segundo_nombre) {
        $this->segundo_nombre = $this->db->real_escape_string($segundo_nombre);
    }

    function setPrimer_apellido($primer_apellido) {
        $this->primer_apellido = $this->db->real_escape_string($primer_apellido);
    }

    function setSegundo_apellido($segundo_apellido) {
        $this->segundo_apellido = $this->db->real_escape_string($segundo_apellido);
    }

    
    function setGenero($genero) {
        $this->genero = $this->db->real_escape_string($genero);
    }

    function setEstado_civil($estado_civil) {
        $this->estado_civil = $this->db->real_escape_string($estado_civil);
    }

    function setFecha_nacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $this->db->real_escape_string($fecha_nacimiento);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setTelefono($telefono) {
        $this->telefono = $this->db->real_escape_string($telefono);
    }

    function setCorreo($correo) {
        $this->correo = $this->db->real_escape_string($correo);
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function setId_ciudad($id_ciudad) {
        $this->id_ciudad = $this->db->real_escape_string($id_ciudad);
    }

    function setId_rol($id_rol) {
        $this->id_rol = $this->db->real_escape_string($id_rol);
    }

    function setId_estado($id_estado) {
        $this->id_estado = $this->db->real_escape_string($id_estado);
    }
    
    function setFecha_ingreso($fecha_ingreso) {
        $this->fecha_ingreso = $this->db->real_escape_string($fecha_ingreso);
    }

    
    //Funcion para obtener datos del usuario
    public function obtenerusuario() {
        $query = $this->db->query("SELECT u.id,u.identidad,u.primer_nombre,u.segundo_nombre,u.primer_apellido,u.segundo_apellido,u.genero,u.estado_civil,u.fecha_nacimiento,u.direccion,u.telefono,u.correo,u.contrasena,u.fecha_ingreso,d.id as iddepartamento,d.descripcion as departamento, c.id as idciudad,c.descripcion as ciudad,r.id as id_rol,r.descripcion as rol, e.id as idestado,e.descripcion as estado FROM departamento as d, usuario as u, estado as e, ciudad as c, rolusuario as r WHERE c.id_departamento = d.id AND u.id_estado = e.id AND u.id_ciudad = c.id  AND u.id_rol = r.id ORDER BY u.id ASC ");
        return $query;
    }
    
        
    //Funcion para obtener estado activo e inactivo
    public function obtenerestado($tabla) {
        $query = $this->db->query("select * from $tabla WHERE id = 1 OR id = 2 ORDER BY id ASC ");
        return $query;
    }
     
    
        //Funcion para obtener del usuario a modificar
    public function modificar() {

        $usuario = $this->db->query("SELECT u.id,u.identidad,u.primer_nombre,u.segundo_nombre,u.primer_apellido,u.segundo_apellido,u.genero,u.estado_civil,u.fecha_nacimiento,u.direccion,u.telefono,u.correo,u.contrasena,u.fecha_ingreso,d.id as iddepartamento,d.descripcion as departamento, c.id as idciudad,c.descripcion as ciudad,r.id as id_rol,r.descripcion as rol, e.id as idestado, e.descripcion as estado FROM departamento as d, usuario as u, estado as e, ciudad as c, rolusuario as r WHERE c.id_departamento = d.id AND u.id_estado = e.id AND u.id_ciudad = c.id  AND u.id_rol = r.id AND u.id= '{$this->getId()}' ");

        return $usuario->fetch_object();
    }


    //Funcion para insertar datos del usuario
    public function insertarUsuario() {
        $sql = "INSERT INTO usuario VALUES(NULL,'{$this->getIdentidad()}','{$this->getPrimer_nombre()}','{$this->getSegundo_nombre()}','{$this->getPrimer_apellido()}','{$this->getSegundo_apellido()}','{$this->getGenero()}','{$this->getEstado_civil()}','{$this->getFecha_nacimiento()}','{$this->getDireccion()}','{$this->getTelefono()}','{$this->getCorreo()}','{$this->getContrasena()}','{$this->getId_ciudad()}','{$this->getId_rol()}','1','{$this->getFecha_ingreso()}')";

        $insertar = $this->db->query($sql);   //ejecucion del query para insertar datos del usuario
        $resultado = false; // variable resultado instanciada en falso

        if ($insertar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }
    
        //Funcion para modificar datos del usuario
    public function modificarUsuario() {
        $sql = "UPDATE usuario SET identidad = '{$this->getIdentidad()}',primer_nombre = '{$this->getPrimer_nombre()}',segundo_nombre = '{$this->getSegundo_nombre()}',primer_apellido = '{$this->getPrimer_apellido()}',segundo_apellido = '{$this->getSegundo_apellido()}',genero = '{$this->getGenero()}',estado_civil = '{$this->getEstado_civil()}',fecha_nacimiento = '{$this->getFecha_nacimiento()}',direccion = '{$this->getDireccion()}',telefono = '{$this->getTelefono()}',correo = '{$this->getCorreo()}',id_ciudad = '{$this->getId_ciudad()}',id_rol = '{$this->getId_rol()}',id_estado = '{$this->getId_estado()}',fecha_ingreso = '{$this->getFecha_ingreso()}' WHERE id='{$this->getId()}' ";
        $modificar = $this->db->query($sql);   //ejecucion del query para insertar datos del usuario
        $resultado = false; // variable resultado instanciada en falso

        if ($modificar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }
    
    
        //funcion para resetear la contraseña del Usuario
    public function resetearUsuario() {
        $sql = "UPDATE usuario SET contrasena = '{$this->getContrasena()}' WHERE id= '{$this->getId()}' ";
        $eliminar = $this->db->query($sql);   //ejecucion del query para insertar datos del Usuario
        
        $resultado = false; //variable de estado de la consulta
        if ($eliminar) {// si la condicion de insertar es verdadera entra al if
            $resultado = true;  // se cambia el valor de la condicion a verdadera
        }
        return $resultado; // dpendiendo el query retorna un valor verdadero o falso
    }
    
    

    //funcion para logearse y comprobar si existe el usuario
    public function login() {
        $correo = $this->correo; //correo seteado
        $contrasena = $this->contrasena; //correo seteada
        $resultado = false; //variable de estado de la consulta
        //comprobar si existe e usuario
        $sql = "SELECT u.id,u.identidad,u.primer_nombre,u.segundo_nombre,u.primer_apellido,u.segundo_apellido,u.genero,u.estado_civil,u.fecha_nacimiento,u.direccion,u.telefono,u.correo,u.contrasena,u.id_ciudad as id_ciudad,u.id_rol as id_rol,d.id as iddepartamento, d.descripcion as departamento,c.descripcion as ciudad,r.descripcion as rol, e.descripcion as estado FROM departamento as d, usuario as u, estado as e, ciudad as c, rolusuario as r WHERE c.id_departamento=d.id AND u.id_estado = e.id AND u.id_ciudad = c.id  AND u.id_rol = r.id AND  u.id_estado = 1 AND u.correo='$correo'";
        $login = $this->db->query($sql);

        if ($login && $login->num_rows == 1) { //si la consulta de login es verdadera y devuelve un valor  
            $usuario = $login->fetch_object(); //almacenado los datos del usuario en la variable llamado usuario

            //verificar la contraseña
            $verificar = password_verify($contrasena, $usuario->contrasena); //comparacion de la contraseña seteada y la contraseña del objeto usuario que almacena la informacion del usuario

            if ($verificar) {
                $resultado = $usuario; //devuelve el objeto de la base de datos si el usuario y la contraseña son correctas
            }
        }
        return $resultado;
    }

    //funcion para cambiar la coontraseña del usuario
    public function cambiarcontrasena($contraactual) {
        $id = $_SESSION['usuario']->id;
        $contrasena = $this->getContrasena();
        $resultado = false; //variable de estado de la consulta
        //comprobar si la contraseña es valida
        //verificar la contraseña
        $verificar = password_verify($contraactual, $_SESSION['usuario']->contrasena);

        if ($verificar) {
            $sql = "UPDATE usuario SET contrasena = '$contrasena' WHERE id= '$id' ";
            $this->db->query($sql);

            $resultado = true;
        } else {

            $resultado = false;
        }
        return $resultado;
    }

}
