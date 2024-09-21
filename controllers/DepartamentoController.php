<?php

require_once 'models/Departamento.php';
require_once 'models/Base.php';
require_once 'controllers/DepartamentoController.php';

class DepartamentoController {


    public function index() {

        require_once 'models/Base.php';

        $departamento= new Departamento();

        $departamentos = $departamento->obtenerDepartamento();
        
         require_once 'views/departamento/index.php';
    }

    public function nuevo() {

        require_once 'views/departamento/new.php';
    }
    
         //Funcion para cargar informacion del formulario edit de la departamento
    public function edit() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $departamento = new Departamento();
            $departamento->setId($id);
            $dp = $departamento->modificar();
        } else {
            $vista_departamento = new DepartamentoController();
            $vista_departamento->index();
        }

        require_once 'views/departamento/edit.php';
    }

    public function guardar() {
        $vista_departamento = new DepartamentoController();
        $bitacora = new Base();
        
        if (isset($_POST)) {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']: false;
            
            if($descripcion){
                $departamento = new Departamento();
                $departamento->setDescripcion(trim($descripcion));
                $departamento->setId_estado(5);

                 if (isset($_POST['id'])) { //Comprobacion para validar que el id de departamento exista, si existe ejecutara el metodo modificar paciente
                    $id = $_POST['id'];
                    $departamento->setId($id);
                    $guardar = $departamento->modificarDepartamento();
                        if ($guardar) {
                            $_SESSION['registrar'] = "completado";
                                $bitacora->insertarbitacora('departamento', 'Modificar', $_SESSION['usuario']->id);
                                $vista_departamento->index();
                        } else {
                            $_SESSION['registrar'] = "fallido";
                            $vista_departamento->index();
                        }
                
                
                        }else{
                       $guardar = $departamento->insertarDepartamento();
                           if ($guardar) {
                               $_SESSION['registrar'] = "completado";
                                   $bitacora->insertarbitacora('departamento', 'Insertar', $_SESSION['usuario']->id);
                                   $vista_departamento->nuevo();
                           } else {
                               $_SESSION['registrar'] = "fallido";
                               $vista_departamento->nuevo();
                           }
                        }
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_departamento->nuevo();

                }
    
            }

        }
       
            //Funcion para eliminar los datos de la departamento
    public function eliminar() {
        $bitacora = new Base();
        $vista_departamento = new DepartamentoController();
        if (isset($_GET)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;

            if ($id){
                $departamento = new Departamento();
                $departamento->setId(trim($id));
                $eliminar = $departamento->eliminarDepartamento();

                if ($eliminar) {
                    $_SESSION['registrar'] = "eliminar";
                    $bitacora->insertarbitacora('departamento', 'Eliminar', $_SESSION['usuario']->id);
                    $vista_departamento->index();
                } else {
                    $_SESSION['registrar'] = "fallido";
                    $vista_departamento->index();
                }
            } else {
                $_SESSION['registrar'] = "fallido";

                $vista_departamento->index();
            }
        }
    }

}
