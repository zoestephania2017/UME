<?php

require_once 'models/Paciente.php';
require_once 'models/Ciudad.php';
require_once 'models/Departamento.php';
require_once 'Controllers/PacienteController.php';
require_once 'models/Base.php';

class PacienteController {

    public function index() {

        $paciente = new Paciente(); // instancia del modelo usuario
        $pacientes = $paciente->obtenerPaciente($_SESSION['usuario']->id_ciudad);
        require_once 'views/paciente/index.php';
    }

    //Funcion para cargar informacion del formulario nuevo del paciente
    public function nuevo() {

        $departamento = new Departamento();
        $ciudad = new Ciudad();


        $departamentos = $departamento->getdepartamento($_SESSION['usuario']->iddepartamento);
        $ciudades = $ciudad->getCiudad($_SESSION["usuario"]->iddepartamento);
        require_once 'views/paciente/new.php';
    }
    
    
    //Funcion para obtener el paciente segun la ciudad mediante una funcion ajax
    public function getPaciente() {
        
        $paciente = new Paciente();
        $pacientes  = $paciente->getPaciente($_POST['ciudad']);
        echo "<option selected disabled value=''>Seleccione un Paciente...</option>";
        while ($paciente = $pacientes->fetch_object()) {
            echo "<option value='".$paciente->id."'>$paciente->identidad -- $paciente->nombre $paciente->apellido</option>";
        }
        
    }

    //Funcion para cargar informacion del formulario edit del paciente
    public function edit() {
        if (isset($_GET['id']) && isset($_GET['iddepartamento'])) {
            $id = $_GET['id'];
            $iddepartamento = $_GET['iddepartamento'];
            $departamento = new Departamento();
            $ciudad = new Ciudad();
            $paciente = new Paciente();
            $ciudades = $ciudad->getCiudad($iddepartamento);
            $departamentos = $departamento->obtenerDepartamento();
            $paciente->setId($id);
            $pa = $paciente->modificar();
        } else {
            $vista_paciente = new PacienteController();
            $vista_paciente->index();
        }

        require_once 'views/paciente/edit.php';
    }

    //Funcion para almacenar y modificar el usuario en la base de datos
    public function guardar() {
        $bitacora = new Base();
        $vista_paciente = new PacienteController();
        if (isset($_POST)) {
            $genero = isset($_POST['genero']) ? $_POST['genero'] : false;
            $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : false;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;


            if ($genero && $comentario && $ciudad) {

                $paciente = new Paciente();
                $paciente->setIdentidad(trim($_POST['identidad']));
                $paciente->setNombre(trim($_POST['primernombre']));
                $paciente->setApellido(trim($_POST['primerapellido']));
                $paciente->setFecha_nacimiento(trim($_POST['fechanacimiento']));
                $paciente->setOcupacion(trim($_POST['ocupacion']));
                $paciente->setDireccion(trim($_POST['direccion']));
                $paciente->setTelefono(trim($_POST['telefono']));
                $paciente->setGenero(trim($genero));
                $paciente->setEstado_civil(trim($_POST['estadocivil']));
                $paciente->setParentesco(trim($_POST['parentesco']));
                $paciente->setAcompanante(trim($_POST['acompanante']));
                $paciente->setComentario(trim($comentario));
                $paciente->setId_ciudad(trim($ciudad));


                if (isset($_POST['id'])) { //Comprobacion para validar que el id de paciente exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $paciente->setId(trim($id));
                    $guardar = $paciente->modificarPaciente();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('paciente', 'Modificar', $_SESSION['usuario']->id);
                        $vista_paciente->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_paciente->index();
                    }
                } else {// En caso de que exista se ejecutara la funcion de insertar el paciente
                    try{
                    $guardar = $paciente->insertarPaciente();
                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('paciente', 'Insertar', $_SESSION['usuario']->id);
                        $vista_paciente->nuevo();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_paciente->nuevo();
                    }
                    
                    }catch(Exception $e){
                    $_SESSION['registrar'] = "duplicated";
                    $vista_paciente->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_paciente->nuevo();
            }
        }
    }

    //Funcion para eliminar los datos del paciente
    public function eliminar() {
        $bitacora = new Base();
        $vista_paciente = new PacienteController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $paciente = new Paciente();
                $paciente->setId(trim($id));
                $eliminar = $paciente->eliminarPaciente();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('paciente', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_paciente->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_paciente->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_paciente->index();
            }
        }
    }

}
