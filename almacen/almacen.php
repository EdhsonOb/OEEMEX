<?php
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.html');
    exit;
}

// Verificar si el usuario está intentando acceder a una página que no le corresponde
if ($_SESSION['tipo_usuario'] == 'almacen' && basename($_SERVER['PHP_SELF']) == 'archivo.php') {
    header('Location: ../almacen.php');
    exit;
}

if ($_SESSION['tipo_usuario'] == 'archivos' && basename($_SERVER['PHP_SELF']) == 'almacen.php') {
    header('Location: ../archivo.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="cssv2/almacen.css">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Gestor de almacén</title>
</head>

<body onload="<?php
if (isset($_SESSION['pagina_actual']) && $_SESSION['pagina_actual'] == 'inventario') {
    echo 'cargarContenido(\'inventario.php\')';
    unset($_SESSION['pagina_actual']);
} else {
    echo '';
}
?>">
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
          <img style="margin-left: 5%; margin-right: 2%;"src="img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Panel
        </a>
        
        <ul class="nav justify-content-end">
            <li class="nav-item class2">
              <a class="nav-link" style="color: white;" href="cses.php">Cerrar sesion</a>
            </li>
          </ul>
      </nav>

      <div class="contenido-menu" id="contenido">
        
    </div>
    <div class="sliderbar">
    <div id="menu">
        <ul>
            <li class="menuz"><a href="#" class="menuv" style="text-decoration: none;" onclick="cargarContenido('configuracion.php')">Configuración</a></li>
            <li class="menuz"><a href="#" class="menuv" style="text-decoration: none;" onclick="cargarContenido('paneldecontrol.php')">Panel de control</a></li>
            <li class="menuz"><a href="#" class="menuv" style="text-decoration: none;" onclick="cargarContenido('inventario.php')">Inventario</a></li>
        </ul>

    </div>

    </div>



    

</body>

<script src="js/invetario.js"></script>
<script src="js/opcpanelcontrol.js"></script>

</html>