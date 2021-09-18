<?php
// Creamos la conexion a la base de datos
try
{
     $bdd = new PDO('myataDeDNamesql:host=HostSuyo;dbname=NameSuDataBase', 'root', '');
}
catch(Exception $ex)
{
    die('ERROR!! No se pudo conectar.: '.$ex->getMessage());
}
