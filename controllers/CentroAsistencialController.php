<?php

require_once 'models/CentroAsistencial.php';
require_once 'models/Base.php';
require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'controllers/CentroAsistencialController.php';

class CentroAsistencialController {

    public function index() {

        $centroasistencial = new CentroAsistencial();

        $centroasistenciales = $centroasistencial->obtenerCentroAsistencial();

        require_once 'views/centroasistencial/index.php';
    }

    public function nuevo() {

        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();

        require_once 'views/centroasistencial/new.php';
    }

    //Funcion para obtener el centro asistencial segun la ciudad mediante una funcion ajax
    public function getCentroasistencial() {
        $centro = new CentroAsistencial();
        $centros = $centro->getCentro($_POST['ciudad']);
        echo "<option selected disabled value=''>Seleccione un Centro Asistencial...</option>";
        while ($centro = $centros->fetch_object()) {
            echo "<option value='" . $centro->id . "'>--$centro->descripcion--</option>";
        }
    }

    //Funcion para obtener el centro asistencial segun la ciudad mediante una funcion ajax
    public function reportecentro() {
        $centro = new CentroAsistencial();
        $centros = $centro->getCentro($_POST['ciudad']);
        echo "<option selected disabled value=''>Seleccione un Centro Asistencial...</option>";
        while ($centro = $centros->fetch_object()) {
            echo "<option value='" . $centro->id . "'>--$centro->descripcion--</option>";
        }
        echo "<option value='*'>--Todos los Centros Asistenciales--</option>";
    }

    //Funcion para cargar informacion del formulario edit de la centroasistencial
    public function edit() {
        if (isset($_GET['id']) && isset($_GET['iddepartamento'])) {
            $id = $_GET['id'];
            $iddepartamento = $_GET['iddepartamento'];
            $centroasistencial = new CentroAsistencial();
            $ciudad = new Ciudad();
            $ciudades = $ciudad->getCiudad($iddepartamento);
            $departamento = new Departamento();
            $departamentos = $departamento->obtenerDepartamento();
            $centroasistencial->setId($id);
            $ce = $centroasistencial->modificar();
        } else {
            $vista_centroasistencial = new CentroAsistencialController();
            $vista_centroasistencial->index();
        }

        require_once 'views/centroasistencial/edit.php';
    }

    public function guardar() {
        $vista_centroasistencial = new CentroAsistencialController();
        $bitacora = new Base();

        if (isset($_POST)) {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            if ($descripcion && $ciudad) {
                $centroasistencial = new CentroAsistencial();
                $centroasistencial->setDescripcion(trim($descripcion));
                $centroasistencial->setId_ciudad(trim($ciudad));
                $centroasistencial->setId_estado(5);

                if (isset($_POST['id'])) { //Comprobacion para validar que el id de paciente exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $centroasistencial->setId($id);
                    $guardar = $centroasistencial->modificarCentroAsistencial();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('centroasistencial', 'Modificar', $_SESSION['usuario']->id);
                        $vista_centroasistencial->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_centroasistencial->index();
                    }
                } else {
                    $guardar = $centroasistencial->insertarCentroAsistencial();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('centroasistencial', 'Insertar', $_SESSION['usuario']->id);
                        $vista_centroasistencial->nuevo();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_centroasistencial->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_centroasistencial->nuevo();
            }
        }
    }

    //Funcion para eliminar los datos de la centroasistencial
    public function eliminar() {
        $bitacora = new Base();
        $vista_centroasistencial = new CentroAsistencialController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $centroasistencial = new CentroAsistencial();
                $centroasistencial->setId(trim($id));
                $eliminar = $centroasistencial->eliminarCentroAsistencial();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('centroasistencial', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_centroasistencial->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_centroasistencial->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_centroasistencial->index();
            }
        }
    }

}
