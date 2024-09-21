<?php

//llamada de modelos y controladores necesarios para este controlador
require_once 'models/Paramedico.php';
require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'Controllers/InicioController.php';
require_once 'Controllers/ParamedicoController.php';
require_once 'models/Base.php';

class ParamedicoController {

    public function index() {

        $paramedico = new Paramedico(); // instancia del modelo paramedico

        $paramedicos = $paramedico->obtenerParamedico();

        require_once 'views/paramedico/index.php';
    }

    public function nuevo() {
        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();


        require_once 'views/paramedico/new.php';
    }
    
    
    
        //Funcion para obtener el paramedico mediante una funcion ajax
    public function getParamedico() {
        
        $paramedico = new Paramedico();
        $paramedicos  = $paramedico->getParamedico($_POST['ciudad'],3);
        echo "<option selected disabled value=''>Seleccione un Paramédico...</option>";
        while ($paramedico = $paramedicos->fetch_object()) {
            echo "<option value='".$paramedico->id."'>$paramedico->identidad -- $paramedico->primer_nombre $paramedico->primer_apellido</option>";
        }
        
    }
    
    
            //Funcion para obtener el paramedico mediante una funcion ajax
    public function getParamedicos() {
        
        $paramedico = new Paramedico();
        $paramedicos  = $paramedico->getParamedico($_POST['ciudad'],5);
        echo "<option selected disabled value=''>Seleccione un Paramédico...</option>";
        while ($paramedico = $paramedicos->fetch_object()) {
            echo "<option value='".$paramedico->id."'>$paramedico->identidad -- $paramedico->primer_nombre $paramedico->primer_apellido</option>";
        }
        
    }

    //Funcion para cargar informacion del formulario edit del paramedico
    public function edit() {

        if (isset($_GET['id']) && isset($_GET['iddepartamento'])) {
            $id = $_GET['id'];
            $iddepartamento = $_GET['iddepartamento'];
            $ciudad = new Ciudad();
            $departamento = new Departamento();
            $ciudades = $ciudad->getCiudad($iddepartamento);
            $departamentos = $departamento->obtenerDepartamento();
            $paramedico = new Paramedico();
            $paramedico->setId($id);
            $me = $paramedico->modificar();
        } else {
            $vista_paramedico = new ParamedicoController();
            $vista_paramedico->index();
        }

        require_once 'views/paramedico/edit.php';
    }

    //Funcion para almacenar el paramedico en la base de datos
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
                $paramedico = new Paramedico();
                $vista_paramedico = new ParamedicoController();
                $bitacora = new Base();

                //Agregar todos los campos al metodo
                $paramedico->setIdentidad(trim($identidad));
                $paramedico->setPrimer_nombre(trim($primernombre));
                $paramedico->setSegundo_nombre(trim($segundonombre));
                $paramedico->setPrimer_apellido(trim($primerapellido));
                $paramedico->setSegundo_apellido(trim($segundoapellido));
                $paramedico->setDireccion(trim($direccion));
                $paramedico->setTelefono(trim($telefono));
                $paramedico->setGenero(trim($genero));
                $paramedico->setEstado_civil(trim($estadocivil));
                $paramedico->setFecha_nacimiento(trim($fechanacimiento));
                $paramedico->setId_ciudad(trim($ciudad));
                $paramedico->setId_estado(trim(3));
                $paramedico->setFecha_ingreso(trim($fechaingreso));
                
                if (isset($_POST['id'])) { //Comprobacion para validar que el id de paramedico exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $paramedico->setId(trim($id));
                    $guardar = $paramedico->modificarParamedico();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('paramedico', 'Modificar', $_SESSION['usuario']->id);
                        $vista_paramedico->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_paramedico->index();
                    }
                } else {
                    //Ejecutar la funcion insertarParamedico
                    $guardar = $paramedico->insertarParamedico();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('paramedico', 'Insertar', $_SESSION['usuario']->id);
                        $vista_paramedico->nuevo();
                    } else {
                        $_SESSION['registrar'] = "existe";

                        $vista_paramedico->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_paramedico = new ParamedicoController();
                $vista_paramedico->nuevo();
            }
        }
    }

    //Funcion para eliminar los datos de la paramedico
    public function eliminar() {
        $bitacora = new Base();
        $vista_paramedico = new ParamedicoController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $paramedico = new Paramedico();
                $paramedico->setId(trim($id));
                $eliminar = $paramedico->eliminarParamedico();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('paramedico', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_paramedico->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_paramedico->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_paramedico->index();
            }
        }
    }

}
