<?php

class database{

    // Método estático para conectar a la base de datos
    public static function conectar(){
       
          // Establecer la conexión con la base de datos MySQL
        $conexion = new mysqli('localhost','root','','ume'); //Creacion de Conexion de la base de datos (servidor,nombre de la conexion,contraseña,nombre de base de datos)
        $conexion->query("SET NAMES 'utf8'"); // Hacer que querys de la base de datos conviertan los carateres especiales
        return $conexion;
    }
    
}

