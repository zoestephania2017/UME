<?php
require_once 'models/Bitacora.php';
class BitacoraController{
    
    
    public function index() {
        $bitacora = new Bitacora();

        $bitacoras = $bitacora->obtenerbitacora();

        require_once 'views/bitacora/index.php';
    }
    
    
    
    
}