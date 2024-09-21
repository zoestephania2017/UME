<?php

require_once 'models/PuntoEstrategico.php';
require_once 'models/Base.php';
require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'controllers/PuntoEstrategicoController.php';

class PuntoEstrategicoController {

    public function index() {

        $puntoestrategico = new PuntoEstrategico();

        $puntoestrategicos = $puntoestrategico->obtenerPuntoEstrategico();

        require_once 'views/puntoestrategico/index.php';
    }

    public function nuevo() {


        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();

        require_once 'views/puntoestrategico/new.php';
    }
    
    
        //Funcion para obtener el puntno estrategico mediante una funcion ajax
    public function getPunto() {

        $punto = new PuntoEstrategico();
        $puntos = $punto->getPunto($_POST['ciudad']);
        echo "<option selected disabled value=''>Seleccione un Punto Estratégico...</option>";
        while ($punto = $puntos->fetch_object()) {
            echo "<option value='".$punto->id."'>--".$punto->descripcion."--</option>";
        }
}


    //Funcion para cargar informacion del formulario edit de la puntoestrategico
    public function edit() {

        if (isset($_GET['id']) && isset($_GET['iddepartamento'])) {
            $id = $_GET['id'];
            $iddepartamento = $_GET['iddepartamento'];
            $puntoestrategico = new PuntoEstrategico();
            $ciudad = new Ciudad();
            $departamento = new Departamento();
            $departamentos = $departamento->obtenerDepartamento();
            $ciudades = $ciudad->getCiudad($iddepartamento);
            $puntoestrategico->setId($id);
            $pe = $puntoestrategico->modificar();
        } else {
            $vista_puntoestrategico = new PuntoEstrategicoController();
            $vista_puntoestrategico->index();
        }

        require_once 'views/puntoestrategico/edit.php';
    }

    public function guardar() {
        $vista_puntoestrategico = new PuntoEstrategicoController();
        $bitacora = new Base();

        if (isset($_POST)) {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            if ($descripcion && $ciudad) {
                $puntoestrategico = new PuntoEstrategico();
                $puntoestrategico->setDescripcion(trim($descripcion));
                $puntoestrategico->setId_ciudad(trim($ciudad));
                $puntoestrategico->setId_estado(5);

                if (isset($_POST['id'])) { //Comprobacion para validar que el id  exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $puntoestrategico->setId($id);
                    $guardar = $puntoestrategico->modificarPuntoEstrategico();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('puntoestrategico', 'Modificar', $_SESSION['usuario']->id);
                        $vista_puntoestrategico->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_puntoestrategico->index();
                    }
                } else {
                    $guardar = $puntoestrategico->insertarPuntoEstrategico();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('puntoestrategico', 'Insertar', $_SESSION['usuario']->id);
                        $vista_puntoestrategico->nuevo();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_puntoestrategico->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_puntoestrategico->nuevo();
            }
        }
    }

    //Funcion para eliminar los datos de la puntoestrategico
    public function eliminar() {
        $bitacora = new Base();
        $vista_puntoestrategico = new PuntoEstrategicoController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $puntoestrategico = new PuntoEstrategico();
                $puntoestrategico->setId(trim($id));
                $eliminar = $puntoestrategico->eliminarPuntoEstrategico();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('puntoestrategico', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_puntoestrategico->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_puntoestrategico->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_puntoestrategico->index();
            }
        }
    }

}
