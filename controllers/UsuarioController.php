<?php

//llamada de modelos y controladores necesarios para este controlador
require_once 'models/Usuario.php';
require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'Controllers/LoginController.php';
require_once 'Controllers/InicioController.php';
require_once 'Controllers/UsuarioController.php';
require_once 'models/Base.php';

class UsuarioController {

    public function index() {

        $usuario = new Usuario(); // instancia del modelo usuario

        $usuarios = $usuario->obtenerusuario();

        require_once 'views/usuario/index.php';
    }

    public function nuevo() {
        $departamento = new Departamento();
        $rol = new Base();
        $roles = $rol->obtenerdatos('rolusuario');
        $departamentos = $departamento->obtenerDepartamento();


        require_once 'views/usuario/new.php';
    }

    //Funcion para cargar informacion del formulario edit del usuario
    public function edit() {

        if (isset($_GET['id']) && isset($_GET['iddepartamento'])) {
            $id = $_GET['id'];
            $iddepartamento = $_GET['iddepartamento'];
            $usuario = new Usuario();
            $estado = new Usuario();
            $rol = new Base();
            $ciudad = new Ciudad();
            $departamento = new Departamento();
            $ciudades = $ciudad->getCiudad($iddepartamento);
            $departamentos = $departamento->obtenerDepartamento();
            $estados = $estado->obtenerestado('estado');
            $roles = $rol->obtenerdatos('rolusuario');
            $usuario->setId($id);
            $us = $usuario->modificar();
        } else {
            $vista_usuario = new UsuarioController();
            $vista_usuario->index();
        }

        require_once 'views/usuario/edit.php';
    }

    //Funcion para almacenar el usuario en la base de datos
    public function guardar() {

        $bitacora = new Base();
        if (isset($_POST)) {
            $identidad = isset($_POST['identidad']) ? $_POST['identidad'] : false;
            $primernombre = isset($_POST['primernombre']) ? $_POST['primernombre'] : false;
            $segundonombre = isset($_POST['segundonombre']) ? $_POST['segundonombre'] : false;
            $primerapellido = isset($_POST['primerapellido']) ? $_POST['primerapellido'] : false;
            $segundoapellido = isset($_POST['segundoapellido']) ? $_POST['segundoapellido'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $genero = isset($_POST['genero']) ? $_POST['genero'] : false;
            $estadocivil = isset($_POST['estadocivil']) ? $_POST['estadocivil'] : false;
            $fechanacimiento = isset($_POST['fechanacimiento']) ? $_POST['fechanacimiento'] : false;
            $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : false;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            $fechaingreso = isset($_POST['fechaingreso']) ? $_POST['fechaingreso'] : false;


            if ($identidad && $primernombre && $segundonombre && $primerapellido && $segundoapellido && $direccion && $telefono && $genero && $estadocivil && $fechanacimiento && $correo && $rol && $ciudad && $fechaingreso) {
                $usuario = new Usuario();
                $vista_usuario = new UsuarioController();
                $bitacora = new Base();

                //Agregar todos los campos al metodo
                $usuario->setIdentidad(trim($identidad));
                $usuario->setPrimer_nombre(trim($primernombre));
                $usuario->setSegundo_nombre(trim($segundonombre));
                $usuario->setPrimer_apellido(trim($primerapellido));
                $usuario->setSegundo_apellido(trim($segundoapellido));
                $usuario->setDireccion(trim($direccion));
                $usuario->setTelefono(trim($telefono));
                $usuario->setGenero(trim($genero));
                $usuario->setEstado_civil(trim($estadocivil));
                $usuario->setFecha_nacimiento(trim($fechanacimiento));
                $usuario->setCorreo(trim($correo));
                $usuario->setContrasena(trim('UmeCopeco'));
                $usuario->setId_rol(trim($rol));
                $usuario->setId_ciudad(trim($ciudad));
                $usuario->setFecha_ingreso(trim($fechaingreso));

                if (isset($_POST['id'])) { //Comprobacion para validar que el id de paciente exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $usuario->setId(trim($id));
                    $usuario->setId_estado(trim($_POST['estado']));
                    $guardar = $usuario->modificarUsuario();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('usuario', 'Modificar', $_SESSION['usuario']->id);
                        $vista_usuario->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_usuario->index();
                    }
                } else {
                    try{
                    //Ejecutar la funcion InsertarUsuario
                    $guardar = $usuario->insertarUsuario();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('usuario', 'Insertar', $_SESSION['usuario']->id);
                        $vista_usuario->nuevo();
                    } else {
                        $_SESSION['registrar'] = "existe";

                        $vista_usuario->nuevo();
                    }
                    }catch(Exception $e){
                        $_SESSION['registrar'] = "duplicated";
                        $vista_usuario->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_usuario = new UsuarioController();
                $vista_usuario->nuevo();
            }
        }
    }

    //Funcion para resetear la contraseña del usuario
    public function resetear() {
        $bitacora = new Base();
        $vista_usuario = new UsuarioController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $usuario = new Usuario();
                $usuario->setId(trim($id));
                $usuario->setContrasena(trim('UmeCopeco'));
                $resetear = $usuario->resetearUsuario();

                if ($resetear) {
                    $_SESSION['registrar'] = "resetear";
                    $bitacora->insertarbitacora('usuario', 'Resetear Contraseña', $_SESSION['usuario']->id);
                    $vista_usuario->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_usuario->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_usuario->index();
            }
        }
    }

    public function login() {

        if (isset($_POST)) {

            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
            $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
            //identificar al usuario
            //consulta a la base de datos

            if ($usuario && $contrasena) {

                $vista_usuario = new UsuarioController();
                $vistainicio = new InicioController();
                $usuario = new Usuario();
                $usuario->setCorreo($_POST['usuario']);
                $usuario->setContrasena($_POST['contrasena']);
                $identidadusuario = $usuario->login();

                if ($identidadusuario && is_object($identidadusuario)) {
                    $_SESSION['usuario'] = $identidadusuario;
                    $_SESSION['login'] = "Exitoso";
                    $vistainicio->index();
                } else {
                    $_SESSION['login'] = "Fallido";
                }
            } else {

                $_SESSION['login'] = "Vacio";
            }
        }
    }

    public function cambiarcontrasena() {

        $vistaperfil = new LoginController();

        $bitacora = new Base();

        if (isset($_POST)) {

            $contraseña1 = isset($_POST['nuevacontrasena']) ? $_POST['nuevacontrasena'] : false;
            $contraseña2 = isset($_POST['confirmarcontrasena']) ? $_POST['confirmarcontrasena'] : false;
            $contraseñaactual = isset($_POST['contrasenaactual']) ? $_POST['contrasenaactual'] : false;
            if ($contraseña1 === $contraseña2 && $contraseña1 && $contraseña2 && $contraseñaactual) {
                $usuario = new Usuario();
                $usuario->setContrasena($_POST['nuevacontrasena']);
                $verficar = $usuario->cambiarcontrasena($contraseñaactual);

                if (!$verficar) {
                    $_SESSION['cambiocontrasena'] = "coincide";
                    $vistaperfil->perfil();
                } else {
                    $_SESSION['cambiocontrasena'] = "completado";
                    utilidades::destruirSesion('login');
                    $bitacora->insertarbitacora('usuario', 'Modificacion de Contraseña', $_SESSION['usuario']->id);
                    $vistaperfil->login();
                }
            } else {
                $_SESSION['cambiocontrasena'] = "fallido";
                $vistaperfil->perfil();
            }
        }
    }

}
