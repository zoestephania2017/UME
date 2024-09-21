<?php

//Funcion para cargar todas los ficheros que guarda la carpeta controllers
function controllers_autoload($nombreclase){
	include 'controllers/' . $nombreclase . '.php';
}


//Busca los archivos con el nombre de la clase
spl_autoload_register('controllers_autoload');