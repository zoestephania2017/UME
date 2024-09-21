<?php

class utilidades {

    public static function destruirSesion($nombre) {
        if (isset($_SESSION[$nombre])){
            $_SESSION[$nombre] = null;
        unset($_SESSION[$nombre]);
        }
        return $nombre;
    }
    


}
