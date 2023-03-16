<?php
session_start();

include "../bd/conectarbd.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../cssv2/agg.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <title>Agregar productos</title>
</head>

<body>

  <nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="#">
      <img style="margin-left: 5%; margin-right: 2%;" src="../img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Panel de control
    </a>

    <ul class="nav justify-content-end">
      <li class="nav-item class2">
        <a class="nav-link" style="color: white;" href="../cses.php">Cerrar sesion</a>
      </li>
    </ul>
  </nav>
  <header>Agregar productos</header>
  <form id="form" action="../../listar_productos.php" method="POST" class="topBefore">

    <input id="name" name="nombre" type="text" placeholder="Nombre del producto">
    <input id="email" name="cantidad" type="number" placeholder="Cantidad">
    <input id="email" name="precio" type="number" placeholder="Precio">
    <textarea id="message" name="descripcion" type="text" placeholder="Descripcion"></textarea>
    <input type="submit" name="agregar" value="Agregar">
    <!--<input id="submit" type="submit" name="agregar" value="Agregar"> -->


  </form>
  <script src="js/invetario.js"></script>
  <a href="#" onclick="history.go(-1);return false;">Regresar</a>
</body>

</html>