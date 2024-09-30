<?php

//llamada de modelos y controladores necesarios para este controlador
require_once 'models/Conductor.php';
require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'Controllers/InicioController.php';
require_once 'Controllers/ConductorController.php';
require_once 'models/Base.php';

class ConductorController {

    public function index() {

        $conductor = new Conductor(); // instancia del modelo conductor

        $conductores = $conductor->obtenerConductor();

        require_once 'views/conductor/index.php';
    }

    public function nuevo() {
        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();


        require_once 'views/conductor/new.php';
    }

    //Funcion para obtener el conductor  mediante una funcion ajax
    public function getConductor() {

        $conductor = new Conductor();
        $conductores = $conductor->getConductor($_POST['ciudad'],3);
        echo "<option selected disabled value=''>Seleccione un Conductor...</option>";
        while ($conductor = $conductores->fetch_object()) {
            echo "<option value='" . $conductor->id . "'>$conductor->identidad -- $conductor->primer_nombre $conductor->primer_apellido</option>";
        }
    }
    
        //Funcion para obtener el conductor  mediante una funcion ajax
    public function getConductores() {

        $conductor = new Conductor();
        $conductores = $conductor->getConductor($_POST['ciudad'],5);
        echo "<option selected disabled value=''>Seleccione un Conductor...</option>";
        while ($conductor = $conductores->fetch_object()) {
            echo "<option value='" . $conductor->id . "'>$conductor->identidad -- $conductor->primer_nombre $conductor->primer_apellido</option>";
        }
    }

    //Funcion para cargar informacion del formulario edit del conductor
    public function edit() {

        if (isset($_GET['id']) && isset($_GET['iddepartamento'])) {
            $id = $_GET['id'];
            $iddepartamento = $_GET['iddepartamento'];
            $ciudad = new Ciudad();
            $departamento = new Departamento();
            $ciudades = $ciudad->getCiudad($iddepartamento);
            $departamentos = $departamento->obtenerDepartamento();
            $conductor = new Conductor();
            $conductor->setId($id);
            $me = $conductor->modificar();
        } else {
            $vista_conductor = new ConductorController();
            $vista_conductor->index();
        }

        require_once 'views/conductor/edit.php';
    }

    //Funcion para almacenar el conductor en la base de datos
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
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            $fechaingreso = isset($_POST['fechaingreso']) ? $_POST['fechaingreso'] : false;


            if ($identidad && $primernombre && $segundonombre && $primerapellido && $segundoapellido && $direccion && $telefono && $genero && $estadocivil && $fechanacimiento && $ciudad && $fechaingreso) {
                $conductor = new Conductor();
                $vista_conductor = new ConductorController();
                $bitacora = new Base();

                //Agregar todos los campos al metodo
                $conductor->setIdentidad(trim($identidad));
                $conductor->setPrimer_nombre(trim($primernombre));
                $conductor->setSegundo_nombre(trim($segundonombre));
                $conductor->setPrimer_apellido(trim($primerapellido));
                $conductor->setSegundo_apellido(trim($segundoapellido));
                $conductor->setDireccion(trim($direccion));
                $conductor->setTelefono(trim($telefono));
                $conductor->setGenero(trim($genero));
                $conductor->setEstado_civil(trim($estadocivil));
                $conductor->setFecha_nacimiento(trim($fechanacimiento));
                $conductor->setId_ciudad(trim($ciudad));
                $conductor->setId_estado(trim(3));
                $conductor->setFecha_ingreso(trim($fechaingreso));

                if (isset($_POST['id'])) { //Comprobacion para validar que el id de conductor exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $conductor->setId(trim($id));
                    $guardar = $conductor->modificarConductor();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('conductor', 'Modificar', $_SESSION['usuario']->id);
                        $vista_conductor->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_conductor->index();
                    }
                } else {
                    try{
                    //Ejecutar la funcion insertarConductor
                    $guardar = $conductor->insertarConductor();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('conductor', 'Insertar', $_SESSION['usuario']->id);
                        $vista_conductor->nuevo();
                    } else {
                        $_SESSION['registrar'] = "existe";

                        $vista_conductor->nuevo();
                    }
                
                    }catch(Exception $e){
                        $_SESSION['registrar'] = "duplicated";
                        $vista_conductor->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_conductor = new ConductorController();
                $vista_conductor->nuevo();
            }
        }
    }

    //Funcion para eliminar los datos de la conductor
    public function eliminar() {
        $bitacora = new Base();
        $vista_conductor = new ConductorController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $conductor = new Conductor();
                $conductor->setId(trim($id));
                $eliminar = $conductor->eliminarConductor();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('conductor', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_conductor->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_conductor->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_conductor->index();
            }
        }
    }

}
