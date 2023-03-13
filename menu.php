<?php
session_start();

// Verificar que el usuario haya iniciado sesión y sea del tipo "admin"
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'admin') {
  header('Location: index.html');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="cssv2/menu.css">
    <link rel="shortcut icon" href="img/logo1.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Menu de opciones</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
          <img src="img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
          <h4 style="color: red">OEEMEX</h4>
        </a>
        <ul class="nav justify-content-end">
            <li class="nav-item class2">
              <a class="nav-link" href="cses.php">Cerrar sesion</a>
            </li>
          </ul>
      </nav>

    <div class="card-deck" >
        <div class="card img1"  style="width: 400px; background-color: transparent; border: 0px;" >
            <img  class="card-img-top" src="img/imgarchivos.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Gestor de archivos</h5>
                <p class="card-text">Aqui podras subir tus archivos, ver el de los demas y descargar archivos.</p>
                <p class="card-text"><input type="button" class="btn btn-primary" name="archivos" value="Entrar" onclick="location.href='archivo.php'"></p>
            </div>
        </div>
        <div class="card img2" style="width: 400px; background-color: transparent;  border: 0px;">
            <img id="textin" class="card-img-top partebaja" src="img/inventario.png" alt="Card image cap">
            <div class="card-body inve">
                <h5 class="card-title">Inventario de almacen</h5>
                <p class="card-text">Aqui podras ver y administrar el inventario.</p>
                <p class="card-text"><input type="button" class="btn btn-primary" name="inventario" value="Entrar" onclick="location.href='almacen.php'"></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>