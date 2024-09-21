
<?php
session_start();
require __DIR__.'/vendor/autoload.php'; //cargar libreria para exportar a pdf
require 'config/database.php';//cargar condiguracion de base de datos
require 'autoload.php';//autocarga de todas las clases
require 'config/parameters.php'; //carga de los parametros ubicado en la carpeta de configuraciones
require 'helpers/utilidades.php'; //carga del  parametros ubicado en la carpeta helpers
require('fpdf/fpdf.php');


function error() {
    $error = new ErrorController();
    $error->index();
}

function login() {
    $error = new LoginController();
    $error->login();
}



if (isset($_GET['controlador'])) {

    $nombre_controlador = $_GET['controlador'] . 'Controller'; // se almacena la variable controlador y se guarda en nombre_controlador  
} elseif (!isset($_GET['controlador']) && !isset($_GET['accion'])) {
    $nombre_controlador = controlador_default;
} else {
    error();
}


if (isset($nombre_controlador) && class_exists($nombre_controlador)) { //si el controlador no esta vacio y si el controlador existe en la clase, entonces instancia el objeto
    $controlador = new $nombre_controlador(); //instancia de objeto y se manda la variable nombre_controlador para instanciarlo


    if (isset($_GET['accion']) && method_exists($controlador, $_GET['accion'])) { // si el controlador y el metodo de existen y la variable accion no esta vacia..

        if(!isset($_SESSION['login'])){
        $accion = $_GET['accion']; // crear una variable accion que almacena la variable get

        $controlador->$accion(); // una vez instanciado el objeto del controlador le manda la variable acccion para ejecutar la funcion
        }
        if ($_SESSION['login'] == "Exitoso" && isset($_SESSION['login'])) {
     

            $accion = $_GET['accion']; // crear una variable accion que almacena la variable get

            $controlador->$accion(); // una vez instanciado el objeto del controlador le manda la variable acccion para ejecutar la funcion


         
        } else {

            login();
        }
    } elseif (!isset($_GET['controlador']) && !isset($_GET['accion'])) {
        $acciondefault = accion_default;
        $controlador->$acciondefault(); // una vez instanciado el objeto del cntrolador le manda la variable acccion para ejecutar la funcion
    } else {

        error();
    }
} else {

    error();
}





    
  