<?php

require_once 'models/Sala.php';
require_once 'models/Base.php';
require_once 'controllers/SalaController.php';

class SalaController {


    public function index() {

        $sala= new Sala();

        $salas = $sala->obtenerSala();
        
         require_once 'views/sala/index.php';
    }

    public function nuevo() {

        require_once 'views/sala/new.php';
    }
    
    
    
         //Funcion para cargar informacion del formulario edit de la sala
    public function edit() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sala = new Sala();
            $sala->setId($id);
            $di = $sala->modificar();
        } else {
            $vista_sala = new SalaController();
            $vista_sala->index();
        }

        require_once 'views/sala/edit.php';
    }
    
    

    public function guardar() {
        $vista_sala = new SalaController();
        $bitacora = new Base();
        
        if (isset($_POST)) {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']: false;
            
            if($descripcion){
                $sala = new Sala();
                $sala->setDescripcion(trim($descripcion));
                $sala->setId_estado(5);

                 if (isset($_POST['id'])) { //Comprobacion para validar que el id de paciente exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $sala->setId($id);
                    $guardar = $sala->modificarSala();
                        if ($guardar) {
                            $_SESSION['registrar'] = "completado";
                                $bitacora->insertarbitacora('sala', 'Modificar', $_SESSION['usuario']->id);
                                $vista_sala->index();
                        } else {
                            $_SESSION['registrar'] = "fallido";
                            $vista_sala->index();
                        }
                
                
                        }else{
                       $guardar = $sala->insertarSala();
                           if ($guardar) {
                               $_SESSION['registrar'] = "completado";
                                   $bitacora->insertarbitacora('sala', 'Insertar', $_SESSION['usuario']->id);
                                   $vista_sala->nuevo();
                           } else {
                               $_SESSION['registrar'] = "fallido";
                               $vista_sala->nuevo();
                           }
                        }
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_sala->nuevo();

                }
            
            }

        }
        
        
        
        
            //Funcion para eliminar los datos de la sala
    public function eliminar() {
        $bitacora = new Base();
        $vista_sala = new SalaController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id){
                $sala = new Sala();
                $sala->setId(trim($id));
                $eliminar = $sala->eliminarSala();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('sala', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_sala->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_sala->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_sala->index();
            }
        }
    }

}
