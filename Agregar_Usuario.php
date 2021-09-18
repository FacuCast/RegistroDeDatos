<?php

// Optine los datos mediante POST para agregarlos a la base de datos
$Usuario = $_POST['Usuario']; // Optine los datos para agregarlos a la base de datos
$Edad = $_POST['Edad'];
$Email = $_POST['Email'];
$Contrasena = $_POST['Contrasena'];

// Conexion con MongoDB
///$client = new MongoDB\Client(
   // 'mongodb+srv://<username>:<password>@<cluster-address>/test?retryWrites=true&w=majority'
//);
//$db = $client->test;
// Incluimos la conexion a la base de datos
include_Once 'Conexion.php';
// sql_Agregar guardara esa consulta SQL para agregar los datos
$sql_Agregar = 'INSERT INTO registro_dato (usuario_n,edad_n,email,contrasena) VALUES (?,?,?,?)';
// Preparamos el enviado de datos
$Sentencia_Agregar = $bdd ->prepare($sql_Agregar);
// Si todos los datos cargados son validos se agregaran
if ($Sentencia_Agregar->execute(array($Usuario,$Edad,$Email,$Contrasena))){
    echo 'Agregado<br>'; // Mensaje de confirmacion de la carga de datos
} else {
    echo 'Errohr<br>'; // Mensaje de error de la carga de datos
}

    // Incluimos archivos para hacer el envio de Emails
    require 'includen\PHPMailer.php';
    require 'includen\SMTP.php';
    require 'includen\Exception.php';
    // Usamos los archivos
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(); // Asignamos la funcion de PHPMailer a $mail para que haga sus funciones

    $mail -> isSMTP(); 

    $mail->Host = gethostbyname('smtp.pepipost.com'); /// Host del servidor de Email para enviar Emails

    $mail -> SMTPAuth = "true";

    $mail -> SMTPSecure = "tls";

    $mail -> Port = "587"; // Puerto para enviar Emails

    $mail -> Username = "tumail@gmail.com"; // Email para que Envie los Emails

    $mail -> Password =  "tuclaveclave"; // La clave de ese Email

    $mail -> Subject = "Bienvanido a la pagina de PHP."; // Mensaje

    $mail -> setFrom("$Email"); // Aquien sera enviado

    $mail->Body = 'Hello, this is my message.';

    $mail -> addAddress("$Email");

    if ($mail -> Send() ){ // Consulta para saber si el Email fue enviado

        echo "Mail recibido";
    }else{
        echo "Error DEL". $mail->ErrorInfo;

    }

    $mail -> smtpClose(); // Cerramos la conexion con el servidor de envios de Emails

header('location:index.php'); // Redirige al Index

$Sentencia_Agregar=null; // Cerramos la conexion con la base de datos
$PDO=null; // Cerramos la conexion
?> 