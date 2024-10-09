<?php

require_once 'models/Inicio.php';

class InicioController { //El controlador para manejar 
     //las acciones relacionadas con la página de inicio
                        
    public function index() {

        require_once 'models/Base.php';
       
        //Cargar estadísticas
        $contarciudad = new Inicio();
        $contarusuario = new Inicio();
        $totalatencion = new Inicio();
        $atencionporestado = new Inicio();
        $totaltraslado = new Inicio();
        $atencionciudad = new Inicio();
        $totalgenero = new Inicio();
        $totalgenero1 = new Inicio();
        $totalciudad = new Inicio();
        $totalciudad1 = new Inicio();
        $totaldepartamento = new Inicio();
        $totaldepartamento1 = new Inicio();

        //Llamadas a métodos del modelo
        $contarciudades = $contarciudad->contarciudad($_SESSION['usuario']->id_ciudad); //contar cantidad de ciudades por el usuario logeado
        $contarusuarios = $contarusuario->contarusuario($_SESSION['usuario']->id); //contar cantidad de  por el usuario logeado
        $totalatenciones = $totalatencion->totalatenciones(); //contar el total de atenciones brindadas
        $atencionporestados = $atencionporestado->atencionesporestado(); //contar el total de atenciones por el estado
        $totaltraslados = $totaltraslado->totaltraslado(); //contar el total de atenciones por la ciudad con su descripcion
        $totalgeneros = $totalgenero->totalgenero(); //contar el total de pacientes por genero que se han atendido (funcion para cargar el genero de los pacientes, complementa al de abajo)
        $totalgeneros1 = $totalgenero1->totalgenero(); //contar el total de pacientes por genero que se han atendido (funcion para cargar el total por genero de paciente, complementa al de arriba)
        $totaldepartamento = $totalgenero->totaldepartamentos(); //contar el total de atenciones por departamento que se han atendido (funcion para cargar la descripcion de atenciones por departamento, complementa al de abajo)
        $totaldepartamento1 = $totalgenero1->totaldepartamentos(); //contar el total de atenciones por departamento que se han atendido (funcion para cargar el total de atenciones por departamento, complementa al de arriba)
        $totalciudades = $totalciudad->totalciudades(); //contar el total de atenciones por ciudad que se han atendido (funcion para cargar la descripcion de atenciones por ciudad, complementa al de abajo)
        $totalciudades1 = $totalciudad1->totalciudades(); //contar el total de atenciones por ciudad que se han atendido (funcion para cargar el total de atenciones por ciudad, complementa al de arriba)
        
        
        require_once 'views/inicio/index.php';
    }

}
