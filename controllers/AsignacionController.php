<?php

require_once 'models/Asignacion.php';
require_once 'models/Ambulancia.php';
require_once 'models/Conductor.php';
require_once 'models/Paramedico.php';
require_once 'models/Base.php';
require_once 'models/PuntoEstrategico.php';
require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'controllers/AsignacionController.php';

class AsignacionController {

    public function index() {

        $asignacion = new Asignacion();

        $asignaciones = $asignacion->obtenerAsignacion();

        require_once 'views/asignacion/index.php';
    }

    public function nuevo() {
        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();

        require_once 'views/asignacion/new.php';
    }

//Funcion para cargar informacion del formulario edit de la asignacion
    public function edit() {
        if (isset($_GET['id']) && isset($_GET['iddepartamento']) && isset($_GET['idciudad']) && isset($_GET['idpunto'])) {
            $id = $_GET['id'];
            $iddepartamento = $_GET['iddepartamento'];
            $idciudad = $_GET['idciudad'];
            $idpunto = $_GET['idpunto'];
            $asignacion = new Asignacion();
            $ambulancia = new Ambulancia();
            $conductor = new Conductor();
            $paramedico = new Paramedico();
            $punto = new PuntoEstrategico();
            $ciudad = new Ciudad();
            $departamento = new Departamento();
            $ciudades = $ciudad->getCiudad($iddepartamento);
            $departamentos = $departamento->obtenerDepartamento();
            $ambulancias = $ambulancia->getAmbulancia($idpunto, 5);
            $conductores = $conductor->getConductor($idciudad, 5);
            $paramedicos = $paramedico->getParamedico($idciudad, 5);

            $puntos = $punto->getPunto($idciudad);
            $asignacion->setId($id);
            $as = $asignacion->modificar();
        } else {
            $vista_asignacion = new AsignacionController();
            $vista_asignacion->index();
        }
        require_once 'views/asignacion/edit.php';
    }

    public function guardar() {
        $vista_asignacion = new AsignacionController();
        $bitacora = new Base();
        $cambioestado = new Base(); //funcion para cambiar el estado del conductor

        if (isset($_POST)) {
            $conductor = isset($_POST['conductor']) ? $_POST['conductor'] : false;
            $paramedico = isset($_POST['paramedico']) ? $_POST['paramedico'] : false;
            $ambulancia = isset($_POST['ambulancia']) ? $_POST['ambulancia'] : false;
            $fecha_ingreso = isset($_POST['fechaingreso']) ? $_POST['fechaingreso'] : false;
            if ($conductor && $paramedico && $ambulancia) {
                $asignacion = new Asignacion();
                $asignacion->setId_conductor(trim($conductor));
                $asignacion->setId_paramedico(trim($paramedico));
                $asignacion->setId_ambulancia(trim($ambulancia));
                $asignacion->setFecha_ingreso(trim($fecha_ingreso));
                $asignacion->setId_estado(5);


                if (isset($_POST['id'])) { //Comprobacion para validar que el id de asignacion exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $asignacion->setId($id);
                    $guardar = $asignacion->modificarAsignacion();
                    if ($guardar) {

                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('Asignacion de ambulancia', 'Modificar', $_SESSION['usuario']->id);
                        $vista_asignacion->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_asignacion->index();
                    }
                } else {
                    $guardar = $asignacion->insertarAsignacion();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('Asignacion de ambulancia', 'Insertar', $_SESSION['usuario']->id);
                        $cambioestado->cambioestado('conductor', $conductor);
                        $cambioestado->cambioestado('paramedico', $paramedico);
                        $cambioestado->cambioestado('ambulancia', $ambulancia);
                        $vista_asignacion->nuevo();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_asignacion->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_asignacion->nuevo();
            }
        }
    }

//Funcion para eliminar los datos de la asignacion
    public function eliminar() {
        $bitacora = new Base();
        $vista_asignacion = new AsignacionController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $asignacion = new Asignacion();
                $asignacion->setId(trim($id));
                $eliminar = $asignacion->eliminarAsignacion();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('Asignacion de ambulancia', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_asignacion->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_asignacion->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_asignacion->index();
            }
        }
    }

}
