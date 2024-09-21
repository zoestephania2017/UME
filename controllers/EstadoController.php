<?php

require_once 'models/Estado.php';

class EstadoController {

    public function index() {

        require_once 'models/Base.php';

        $estado = new Base();

        $estados = $estado->obtenerdatos('estado');
        
            require_once 'views/estado/index.php';
    }

    public function nuevo() {

        require_once 'views/estado/new.php';
    }

    public function guardar() {

        
        if (isset($_POST)) {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']: false;
            
            if($descripcion){
                $estado = new Estado();
                $estado->setDescripcion($descripcion);

                $guardar = $estado->insertar();

                if ($guardar) {
                    $_SESSION['registrar'] = "completado";
                } else {
                    $_SESSION['registrar'] = "fallido";
                }

        } else {
            $_SESSION['registrar'] = "fallido";

        }
        require_once 'views/estado/new.php';
    }

}

}
