<?php
// Incluimos la conexion a la base de datos
include_once 'conexion.php';
// Traemos la ID seleccionada de la base de datos mediante GET
$id = $_GET['id'];
// sql_eliminar guardara esa consulta SQL para eliminar los datos
$sql_eliminar = 'DELETE FROM registro_dato WHERE id=?';
$sentencia_eliminar = $bdd->prepare($sql_eliminar); // Preparamos la Eliminacion de datos
$sentencia_eliminar->execute(array($id)); // Elimina los datos

//cerramos conexion base de datos y sentencia
$bdd = null;
$sentencia_eliminar = null;

header('location:index.php'); // Redirige al Index