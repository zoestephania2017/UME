<?php

require_once 'models/Atencion.php';
require_once 'models/Ambulancia.php';
require_once 'models/Paciente.php';
require_once 'models/Ciudad.php';
require_once 'models/Medico.php';
require_once 'models/PuntoEstrategico.php';
require_once 'models/CentroAsistencial.php';
require_once 'models/Departamento.php';
require_once 'Controllers/AtencionController.php';
require_once 'models/Base.php';

class AtencionController {

    public function index() {

        $atencion = new Atencion(); // instancia del modelo usuario
        $atenciones = $atencion->obtenerAtencion($_SESSION['usuario']->id_ciudad);
        require_once 'views/atencion/index.php';
    }

    //Funcion para cargar informacion del formulario nuevo de la atencion
    public function nuevo() {
        $departamento = new Departamento();
        $sala = new Base();
        $diagnostico = new Base();
        $paciente = new Paciente();
        $ambulancia = new Ambulancia();
        $punto = new PuntoEstrategico();
        $CentroAsistencial = new CentroAsistencial();

        $departamentos = $departamento->getdepartamento($_SESSION['usuario']->iddepartamento);
        $salas = $sala->obtenerdatos('sala');
        $diagnosticos = $diagnostico->obtenerdatos('diagnostico');
        $pacientes = $paciente->obtenerPaciente($_SESSION['usuario']->id_ciudad);
        $ambulancias = $ambulancia->obtenerAmbulancia();
        $puntos = $punto->obtenerPuntoEstrategico();
        $CentrosAsistencial = $CentroAsistencial->obtenerCentroAsistencial();
        
        require_once 'views/atencion/new.php';
    }

    //Funcion para cargar informacion del formulario edit de la atencion
    public function edit() {

        if (isset($_GET['id']) && isset($_GET['idpaciente']) && isset($_GET['idpunto']) && isset($_GET['idciudad'])) {
            $id = $_GET['id'];
            $idpaciente = $_GET['idpaciente'];
            $idpunto = $_GET['idpunto'];
            $idciudad = $_GET['idciudad'];
            $atencion = new Atencion();
            $pacientes = new Paciente();
            $ambulancia = new Ambulancia();
            $punto = new PuntoEstrategico();
            $centro = new CentroAsistencial();
            $sala = new Base();
            $diagnostico = new Base();
            $medico = new Medico();
            $puntos = $punto->getPunto($idciudad);
            $ambulancias = $ambulancia->getAmbulancia($idpunto,5);
            $centros = $centro->getCentro($idciudad);
            $medicos = $medico->getMedico($idciudad);
            $salas = $sala->obtenerdatos('sala');
            $diagnosticos = $diagnostico->obtenerdatos('diagnostico');


            $pacientes->setId($idpaciente);
            $pa = $pacientes->modificar();
            $atencion->setId($id);
            $at = $atencion->modificar();
        } else {
            $vista_atencion = new AtencionController();
            $vista_atencion->index();
        }

        require_once 'views/atencion/edit.php';
    }

    //Funcion para almacenar y modificar la atención en la base de datos
    public function guardar() {

        $bitacora = new Base();
        if (isset($_POST)) {

            $centroasistencial = isset($_POST['centroasistencial']) ? $_POST['centroasistencial'] : false;
            $sala = isset($_POST['sala']) ? $_POST['sala'] : false;
            $diagnostico = isset($_POST['diagnostico']) ? $_POST['diagnostico'] : false;
            $medico = isset($_POST['ophs']) ? $_POST['ophs'] : false;
            $tipoincidente = isset($_POST['tipoincidente']) ? $_POST['tipoincidente'] : false;
            $lugarincidente = isset($_POST['lugarincidente']) ? $_POST['lugarincidente'] : false;
            $atencionbrindada = isset($_POST['atencionbrindada']) ? $_POST['atencionbrindada'] : false;
            $traslado = isset($_POST['traslado']) ? $_POST['traslado'] : false;
            $patologia = isset($_POST['patologia']) ? $_POST['patologia'] : false;
            $ambulancia = isset($_POST['ambulancia']) ? $_POST['ambulancia'] : false;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;



            if ($medico && $centroasistencial && $sala && $diagnostico && $tipoincidente && $lugarincidente && $atencionbrindada && $traslado && $patologia && $estado) {
                $atencion = new Atencion();
                $estadopaciente = new Atencion();
                $vista_atencion = new AtencionController();
                $bitacora = new Base();

                $atencion->setId_ambulancia(trim($ambulancia));
                $atencion->setId_centro(trim($centroasistencial));
                $atencion->setId_sala(trim($sala));
                $atencion->setId_diagnostico(trim($diagnostico));
                $atencion->setId_medico(trim($medico));
                $atencion->setTipo_incidente(trim($tipoincidente));
                $atencion->setLugar_incidente(trim($lugarincidente));
                $atencion->setAtencion_brindada(trim($atencionbrindada));
                $atencion->setTraslado(trim($traslado));
                $atencion->setPatologia(trim($patologia));
                $atencion->setEstado(trim($estado));
                $atencion->setId_usuario(trim($_SESSION['usuario']->id));



                if (isset($_POST['id'])) { //Comprobacion para validar que el id de paciente exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $atencion->setId(trim($id));
                    $guardar = $atencion->modificarAtencion();

                    if ($guardar) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('atencion', 'Modificar', $_SESSION['usuario']->id);
                        $vista_atencion->index();
                    } else {
                        $_SESSION['registrar'] = "fallido";
                        $vista_atencion->index();
                    }
                } else {
                    $paciente = isset($_POST['paciente']) ? $_POST['paciente'] : false;
                    $atencion->setId_paciente($paciente);
                    $guardar = $atencion->insertarAtencion();
                    if ($guardar && $paciente) {
                        $_SESSION['registrar'] = "completado";
                        $bitacora->insertarbitacora('atencion', 'Insertar', $_SESSION['usuario']->id);
                        $estadopaciente->setId_paciente(trim($paciente));
                        $estadopaciente->estadopaciente();
                        $vista_atencion->nuevo();
                    } else {
                        $_SESSION['registrar'] = "fallido";

                        $vista_atencion->nuevo();
                    }
                }
            } else {
                $_SESSION['registrar'] = "fallido";
                $vista_atencion = new AtencionController();
                $vista_atencion->nuevo();
            }
        }
    }

    //Funcion para eliminar la atencion
    public function eliminar() {
        $bitacora = new Base();
        $vista_atencion = new AtencionController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id) {
                $atencion = new Atencion();
                $atencion->setId($id);
                $eliminar = $atencion->eliminarAtencion();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('atencion', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_atencion->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_atencion->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_atencion->index();
            }
        }
    }

}
