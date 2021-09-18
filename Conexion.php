<?php
// Creamos la conexion a la base de datos
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=registros', 'root', '');
}
catch(Exception $ex)
{
    die('ERROR!! No se pudo conectar.: '.$ex->getMessage());
}