<?php
// Traemos los datos de la base de datos mediante GET Y las asignamos a distintas variables 
$id = $_GET['id'];
$Usuario = $_GET['Usuario'];
$Edad = $_GET['Edad'];
$Email = $_GET['Email'];
$Contrasena = $_GET['Contrasena'];
// Incluimos la conexion a la base de datos
include_once 'conexion.php';
// sql_editar guardara esa consulta SQL para Actualizar los datos
$sql_editar = 'UPDATE registro_dato SET usuario_n=?,edad_n=?,email=?,contrasena=? WHERE id=?';
$sentencia_editar = $bdd->prepare($sql_editar); // Preparamos la Actualizacion de datos
$sentencia_editar->execute(array($Usuario,$Edad,$Email,$Contrasena,$id)); // Actualiza los datos

//cerramos conexion base de datos y sentencia
$bdd = null; 
$sentencia_editar = null; 

header('location:index.php'); // Redirige al Index