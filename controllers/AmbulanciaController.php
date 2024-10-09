<?php

require_once 'models/Ambulancia.php';
require_once 'models/Paramedico.php';
require_once 'models/Conductor.php';
require_once 'models/Base.php';
require_once 'models/PuntoEstrategico.php';
require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'controllers/AmbulanciaController.php';

class AmbulanciaController {

    // Este método muestra una lista de todas las ambulancias.
    public function index() {

        $ambulancia = new Ambulancia();

        $ambulancias = $ambulancia->obtenerAmbulancia();

        require_once 'views/ambulancia/index.php';
    }

    public function nuevo() {
        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();

        require_once 'views/ambulancia/new.php';
    }

    //Funcion para obtener la ambulancia segun el punto estrategico mediante una funcion ajax
    public function getAmbulancia() {
        $ambulancia = new Ambulancia();
        $ambulancias = $ambulancia->getAmbulancia($_POST['punto'], '3');
        echo "<option selected disabled value=''>Seleccione una Ambulancia...</option>";
        while ($ambulancia = $ambulancias->fetch_object()) {
            echo "<option value='" . $ambulancia->id . "'>--$ambulancia->unidad--</option>";
        }
    }

    //Funcion para obtener la ambulancia segun el punto estrategico mediante una funcion ajax
    public function getAmbulancias() {
        $ambulancia = new Ambulancia(); //instancia de la clase ubicada en models llamada ambulancia
        $ambulancias = $ambulancia->getAmbulancia($_POST['punto'], '3');// llamado del metodo ubicado en ambulancia
        echo "<option selected disabled value=''>Seleccione una Ambulancia...</option>";
        while ($ambulancia = $ambulancias->fetch_object()) { // llenado de informacion a option 
            echo "<option value='" . $ambulancia->id . "'>--$ambulancia->unidad--</option>";
        }
    }

    //Funcion para obtener la ambulancia segun el punto estrategico mediante una funcion ajax
    public function reporteambulancia() {
        $ambulancia = new Ambulancia();
        $ambulancias = $ambulancia->getAmbulancia($_POST['punto'], '3');
        echo "<option selected disabled value=''>Seleccione una Ambulancia...</option>";
        while ($ambulancia = $ambulancias->fetch_object()) {
            echo "<option value='" . $ambulancia->id . "'>--$ambulancia->unidad--</option>";
        }
        echo "<option value='*'>--Todas las Ambulancias--</option>";
    }

//Funcion para cargar informacion del formulario edit de la ambulancia
    public function edit() {
        if (isset($_GET['id']) && isset($_GET['iddepartamento']) && isset($_GET['idciudad'])) {
            $id = $_GET['id'];
            $iddepartamento = $_GET['iddepartamento'];
            $idciudad = $_GET['idciudad'];
            $ambulancia = new Ambulancia();
            $punto = new PuntoEstrategico();
            $ciudad = new Ciudad();
            $departamento = new Departamento();
            $ciudades = $ciudad->getCiudad($iddepartamento);
            $departamentos = $departamento->obtenerDepartamento();
            $puntos = $punto->getPunto($idciudad);
            $ambulancia->setId($id);
            $pe = $ambulancia->modificar();
        } else {
            $vista_ambulancia = new AmbulanciaController();
            $vista_ambulancia->index();
        }
        require_once 'views/ambulancia/edit.php';
    }

    public function guardar() {
        $vista_ambulancia = new AmbulanciaController();
        $bitacora = new Base();

        if (isset($_POST)) {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $punto = isset($_POST['punto']) ? $_POST['punto'] : false;
            $fechaingreso = isset($_POST['fechaingreso']) ? $_POST['fechaingreso'] : false;
            if ($descripcion && $punto && $fechaingreso) {
                $ambulancia = new Ambulancia();
                $ambulancia->setDescripcion(trim($descripcion));
                $ambulancia->setId_punto(trim($punto));
                $ambulancia->setId_estado(3);
                $ambulancia->setFecha_ingreso(trim($fechaingreso));

                if (isset($_POST['id'])) { //Comprobacion para validar que el id de ambulancia exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $ambulancia->setId($id);
                    $guardar = $ambulancia->modificarAmbulancia();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('ambulancia', 'Modificar', $_SESSION['usuario']->id);
                        $vista_ambulancia->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_ambulancia->index();
                    }
                } else {
                    $guardar = $ambulancia->insertarAmbulancia();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('ambulancia', 'Insertar', $_SESSION['usuario']->id);
                        $vista_ambulancia->nuevo();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_ambulancia->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_ambulancia->nuevo();
            }
        }
    }

//Funcion para eliminar los datos de la ambulancia
    public function eliminar() {
        $bitacora = new Base();
        $vista_ambulancia = new AmbulanciaController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $ambulancia = new Ambulancia();
                $ambulancia->setId(trim($id));
                $eliminar = $ambulancia->eliminarAmbulancia();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('ambulancia', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_ambulancia->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_ambulancia->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_ambulancia->index();
            }
        }
    }

}
