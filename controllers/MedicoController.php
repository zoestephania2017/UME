<?php

//llamada de modelos y controladores necesarios para este controlador
require_once 'models/Medico.php';
require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'Controllers/InicioController.php';
require_once 'Controllers/MedicoController.php';
require_once 'models/Base.php';

class MedicoController {

    public function index() {

        $medico = new Medico(); // instancia del modelo medico

        $medicos = $medico->obtenermedico();

        require_once 'views/medico/index.php';
    }

    public function nuevo() {

        $departamento = new Departamento();
        $ciudad = new Ciudad();
        $departamentos = $departamento->obtenerDepartamento();
        $ciudades = $ciudad->obtenerCiudad(); 

        require_once 'views/medico/new.php';
    }
    
    
         //Funcion para obtener el medico segun la ciudad mediante una funcion ajax
    public function getmedico() {
        $medico= new Medico();
        $medicos  = $medico->getMedico($_POST['ciudad']);
        echo "<option selected disabled value=''>Seleccione un Medico...</option>";
        while ($medico = $medicos->fetch_object()) {
            echo "<option value='".$medico->id."'>$medico->identidad -- $medico->primer_nombre $medico->primer_apellido</option>";
        }
        
    }

    //Funcion para cargar informacion del formulario edit del medico
    public function edit() {
        if (isset($_GET['id']) && isset($_GET['iddepartamento'])) {
            $id = $_GET['id'];
            $iddepartamento = $_GET['iddepartamento'];
            $ciudad = new Ciudad();
            $departamento = new Departamento();
            $ciudades = $ciudad->getCiudad($iddepartamento);
            $departamentos = $departamento->obtenerDepartamento();
            $medico = new Medico();
            $medico->setId($id);
            $me = $medico->modificar();
        } else {
            $vista_medico = new MedicoController();
            $vista_medico->index();
        }

        require_once 'views/medico/edit.php';
    }

    //Funcion para almacenar el medico en la base de datos
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
                $medico = new Medico();
                $vista_medico = new MedicoController();
                $bitacora = new Base();

                //Agregar todos los campos al metodo
                $medico->setIdentidad(trim($identidad));
                $medico->setPrimer_nombre(trim($primernombre));
                $medico->setSegundo_nombre(trim($segundonombre));
                $medico->setPrimer_apellido(trim($primerapellido));
                $medico->setSegundo_apellido(trim($segundoapellido));
                $medico->setDireccion(trim($direccion));
                $medico->setTelefono(trim($telefono));
                $medico->setGenero(trim($genero));
                $medico->setEstado_civil(trim($estadocivil));
                $medico->setFecha_nacimiento(trim($fechanacimiento));
                $medico->setId_ciudad(trim($ciudad));
                $medico->setId_estado(trim(5));
                $medico->setFecha_ingreso(trim($fechaingreso));

                if (isset($_POST['id'])) { //Comprobacion para validar que el id de medico exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $medico->setId(trim($id));
                    $guardar = $medico->modificarMedico();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('medico', 'Modificar', $_SESSION['usuario']->id);
                        $vista_medico->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_medico->index();
                    }
                } else {
                    try{
                          //Ejecutar la funcion InsertarMedico
                    $guardar = $medico->insertarMedico();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('medico', 'Insertar', $_SESSION['usuario']->id);
                        $vista_medico->nuevo();
                    } else {
                        $_SESSION['registrar'] = "existe";

                        $vista_medico->nuevo();
                    }
                    }catch(Exception $e){
                        $_SESSION['registrar'] = "duplicated";
                        $vista_medico->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_medico = new MedicoController();
                $vista_medico->nuevo();
            }
        }
    }

    //Funcion para eliminar los datos de la medico
    public function eliminar() {
        $bitacora = new Base();
        $vista_medico = new MedicoController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $medico = new Medico();
                $medico->setId(trim($id));
                $eliminar = $medico->eliminarMedico();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('medico', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_medico->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_medico->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_medico->index();
            }
        }
    }

}
