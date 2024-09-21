<?php

require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'models/Base.php';
require_once 'controllers/CiudadController.php';

class CiudadController {

    public function index() {

        require_once 'models/Base.php';

        $ciudad = new Ciudad();

        $ciudades = $ciudad->obtenerCiudad();

        require_once 'views/ciudad/index.php';
    }

    public function nuevo() {

        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();


        require_once 'views/ciudad/new.php';
    }
    
    
    //Funcion para obtener la ciudad  mediante una funcion ajax
    public function getCiudad() {
        
        $ciudad = new Ciudad();
        $ciudades  = $ciudad->getCiudad($_POST['departamento']);
        echo "<option selected disabled value=''>Seleccione una Ciudad...</option>";
        while ($ciudad = $ciudades->fetch_object()) {
            echo "<option value='".$ciudad->id."'>--".$ciudad->descripcion."--</option>";
        }
        
    }
    
    
     //Funcion para obtener la ciudad donde labora el usuario mediante una funcion ajax
    public function getUnaciudad() {
        $idciudad=$_SESSION['usuario']->id_ciudad;
        $iddepartamento=$_POST['departamento'];
        $ciudad = new Ciudad();
        $ciudades  = $ciudad->getUnaciudad($iddepartamento,$idciudad);
        echo "<option selected disabled value=''>Seleccione una Ciudad...</option>";
        while ($ciudad = $ciudades->fetch_object()) {
            echo "<option value='".$ciudad->id."'>--".$ciudad->descripcion."--</option>";
        }
        
    }
    
         //Funcion para obtener la ciudad donde labora el usuario mediante una funcion ajax
    public function reporteciudad() {
        $idciudad=$_SESSION['usuario']->id_ciudad;
        $iddepartamento=$_POST['departamento'];
        $ciudad = new Ciudad();
        $ciudades  = $ciudad->getUnaciudad($iddepartamento,$idciudad);
        echo "<option selected disabled value=''>Seleccione una Ciudad...</option>";
        while ($ciudad = $ciudades->fetch_object()) {
            echo "<option value='".$ciudad->id."'>--".$ciudad->descripcion."--</option>";
        }
        echo "<option value='*'>--Todas las Ciudades--</option>";
        
    }
        

    //Funcion para cargar informacion del formulario edit de la ciudad
    public function edit() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ciudad = new Ciudad();
            $ciudad->setId($id);
            $ci = $ciudad->modificar();
            $departamento = new Departamento();
            $departamentos = $departamento->obtenerDepartamento();
        } else {
            $vista_ciudad = new CiudadController();
            $vista_ciudad->index();
        }

        require_once 'views/ciudad/edit.php';
    }

    public function guardar() {
        $vista_ciudad = new CiudadController();
        $bitacora = new Base();

        if (isset($_POST)) {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;

            if ($descripcion) {
                $ciudad = new Ciudad();
                $ciudad->setDescripcion(trim($descripcion));
                $ciudad->setId_estado(5);
                $ciudad->setId_departamento(trim($departamento));

                if (isset($_POST['id'])) { //Comprobacion para validar que el id de ciudad exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $ciudad->setId($id);
                    $guardar = $ciudad->modificarCiudad();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('ciudad', 'Modificar', $_SESSION['usuario']->id);
                        $vista_ciudad->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_ciudad->index();
                    }
                } else {
                    $guardar = $ciudad->insertarCiudad();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('ciudad', 'Insertar', $_SESSION['usuario']->id);
                        $vista_ciudad->nuevo();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_ciudad->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_ciudad->nuevo();
            }
        }
    }

    //Funcion para eliminar los datos de la ciudad
    public function eliminar() {
        $bitacora = new Base();
        $vista_ciudad = new CiudadController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $ciudad = new Ciudad();
                $ciudad->setId(trim($id));
                $eliminar = $ciudad->eliminarCiudad();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('ciudad', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_ciudad->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_ciudad->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_ciudad->index();
            }
        }
    }

}
