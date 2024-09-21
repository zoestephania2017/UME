<?php

require_once 'models/Diagnostico.php';
require_once 'models/Base.php';
require_once 'controllers/DiagnosticoController.php';

class DiagnosticoController {


    public function index() {

        $diagnostico= new Diagnostico();

        $diagnosticos = $diagnostico->obtenerDiagnostico();
        
         require_once 'views/diagnostico/index.php';
    }

    public function nuevo() {

        require_once 'views/diagnostico/new.php';
    }
    
         //Funcion para cargar informacion del formulario edit de la diagnostico
    public function edit() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $diagnostico = new Diagnostico();
            $diagnostico->setId($id);
            $di = $diagnostico->modificar();
        } else {
            $vista_diagnostico = new DiagnosticoController();
            $vista_diagnostico->index();
        }

        require_once 'views/diagnostico/edit.php';
    }
    
    

    public function guardar() {
        $vista_diagnostico = new DiagnosticoController();
        $bitacora = new Base();
        
        if (isset($_POST)) {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']: false;
            
            if($descripcion){
                $diagnostico = new Diagnostico();
                $diagnostico->setDescripcion(trim($descripcion));
                $diagnostico->setId_estado(5);

                 if (isset($_POST['id'])) { //Comprobacion para validar que el id de paciente exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $diagnostico->setId($id);
                    $guardar = $diagnostico->modificarDiagnostico();
                        if ($guardar) {
                            $_SESSION['registrar'] = "completado";
                                $bitacora->insertarbitacora('diagnostico', 'Modificar', $_SESSION['usuario']->id);
                                $vista_diagnostico->index();
                        } else {
                            $_SESSION['registrar'] = "fallido";
                            $vista_diagnostico->index();
                        }
                
                
                        }else{
                       $guardar = $diagnostico->insertarDiagnostico();
                           if ($guardar) {
                               $_SESSION['registrar'] = "completado";
                                   $bitacora->insertarbitacora('diagnostico', 'Insertar', $_SESSION['usuario']->id);
                                   $vista_diagnostico->nuevo();
                           } else {
                               $_SESSION['registrar'] = "fallido";
                               $vista_diagnostico->nuevo();
                           }
                        }
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_diagnostico->nuevo();

                }
            
            }

        }
        
        
        
        
            //Funcion para eliminar los datos de la diagnostico
    public function eliminar() {
        $bitacora = new Base();
        $vista_diagnostico = new DiagnosticoController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id){
                $diagnostico = new Diagnostico();
                $diagnostico->setId(trim($id));
                $eliminar = $diagnostico->eliminarDiagnostico();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('diagnostico', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_diagnostico->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_diagnostico->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_diagnostico->index();
            }
        }
    }

}
