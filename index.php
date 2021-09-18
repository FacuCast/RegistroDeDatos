<?php
// Incluimos la conexion a la base de datos
include_once 'conexion.php';

//LEER los datos de la base de datos
$sql_leer = 'SELECT * FROM registro_dato';
$gsent = $bdd->prepare($sql_leer);
$gsent->execute();
$resultado = $gsent->fetchAll();

if($_GET){ // Trae todos los datos mediante el Metodo GET
    $id = $_GET['id'];
    // sql_unico guardara esa consulta SQL para Mostrar todos los datos
    $sql_unico = 'SELECT * FROM registro_dato WHERE id=?'; 
    $gsent_unico = $bdd->prepare($sql_unico);
    $gsent_unico->execute(array($id));
    $resultado_unico = $gsent_unico->fetch();

    $gsent_unico = null; //cerramos la sentencia
}
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <title>Datos Ingresados</title>
  </head>
  <body>
    
    <div class="container mt-5">
        <div class="row">
            
            <div class="col-md-6">
                <h2>MIS REGISTROS</h2>

                <!-- El foreach Traera todos los datos -->
                <?php foreach($resultado as $dato): ?>
                
                <div 
                class="alert alert-<?php echo $dato['registro_dato'] ?> text-uppercase" 
                role="alert">
                    <?php echo $dato['usuario_n'] ?> 
                    - 
                    <?php echo $dato['edad_n'] ?>
                    -
                    <?php echo $dato['email'] ?>
                    - 
                    <?php echo $dato['contrasena'] ?>

                    <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="float-right ml-3">
                        <i class="far fa-trash-alt"></i>
                    </a>

                    <a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>
                <!-- El foreach FINALIZA -->
                <?php endforeach ?> 
            
            </div>

            <div class="col-md-6">
                <?php if(!$_GET): ?>
                <h2>AGREGAR ELEMENTOS</h2>
  <form action="Agregar_Usuario.php" method="POST">
    <div class="form-group">
      <!--/////////////////////////////////////////////user/////////////////////////////////////////////////////-->
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
          <i class="far fa-address-book"></i></span></div>
        <input type="text" class="form-control" name="Usuario" placeholder="Ingrese nombre del usuario..." required />
      </div>
      <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
             <i class="far fa-calendar-alt"></i></span></div>
        <input class="form-control" name="Edad" type="numer" placeholder="Ingrese edad..." required />
      </div>
        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////-->
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
             <i class="far fa-envelope"></i></span></div>
        <input class="form-control" name="Email" type="Text" placeholder="Ingrese nombre de email..." required />
        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////   -->
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
             <i class="fas fa-unlock-alt"></i></span></div>
        <input class="form-control" name="Contrasena" type="password" placeholder="Ingrese una Contraseña" required />
        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////-->
      </div>
      <button class="btn btn-primary ml-3" name="send" type="submit">ENVIAR</button>
      <a <button class="btn btn-primary" type="button" href="index.php">VER DATOS CARGADOS</button></a>
    </div>
  </form>
                <?php endif ?>

                <?php if($_GET): ?>
                <h2>EDITAR ELEMENTOS</h2>
                <form method="GET" action="editar.php">

                <div class="form-group">
                  <!--/////////////////////////////////////////////user/////////////////////////////////////////////////////-->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                      <i class="far fa-address-book"></i></span></div>
                    <input type="text" class="form-control" name="Usuario" placeholder="Ingrese nuevo nombre del usuario..."
                    value="<?php echo $resultado_unico['usuario_n'] ?>">
                    </div>
          <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                  <div class="input-group mb-3">
                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                        <i class="far fa-calendar-alt"></i></span></div>
                    <input class="form-control" name="Edad" type="numer" placeholder="Ingrese nueva edad..."
                    value="<?php echo $resultado_unico['edad_n'] ?>">
                    </div>
                  </div>
  <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////-->

                  <div class="input-group mb-3">
                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                        <i class="far fa-envelope"></i></span></div>
                    <input class="form-control" name="Email" type="Text" placeholder="Ingrese nuevo email..."
                    value="<?php echo $resultado_unico['email'] ?>">
                    <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////   -->
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-unlock-alt"></i></span></div>
                    <input class="form-control" name="Contrasena" type="text" placeholder="Ingrese nueva Contraseña"
                    value="<?php echo $resultado_unico['contrasena'] ?>">
      <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////   -->
      <div class="input-group mb-3">
                    <input type="hidden" name="id"
                    value="<?php echo $resultado_unico['id'] ?>">
                    <button class="btn btn-primary mt-3">Agregar</button>
                </form>
        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////-->
      </div>
                <?php endif ?>
            </div>
        
        </div>
        
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>

<?php 
//cerramos conexion base de datos y sentencia
$bdd = null;
$gsent = null;

?>