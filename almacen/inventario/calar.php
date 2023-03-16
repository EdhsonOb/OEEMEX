<?php
session_start();
// cada ../../ dos puntos y la diagonal hace referencia a una carpeta, en este casp estamos pasando de calar, a inventario de inventario a almacen y de ahi sale la ruta
include "../../conectarbd.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

$sql = "SELECT * FROM producto";
$resultado = $conn->query($sql);
// Obtener el ID del producto a modificar de la URL
if (isset($_GET["id"])) {
  $id = $_GET["id"];
} else {
  // Si no se proporcionó un ID, redireccionar al inventario
  header("Location: inventario.php");
  exit();
}

// Obtener los datos del producto de la base de datos
$stmt = $conn->prepare("SELECT nombre, descripcion, cantidad, precio FROM producto WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nombre, $descripcion, $cantidad, $precio);

// Verificar si se encontró información con el ID proporcionado
if ($stmt->fetch()) {
 $id ;
 $nombre  ;
  $descripcion  ;
 $cantidad  ;
 $precio ;
} else {
  echo "No se encontró información con el ID proporcionado.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../cssv2/mod.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <title>Modificar</title>
</head>

<body>

  <nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="#">
      <img style="margin-left: 5%; margin-right: 2%;" src="../../img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Panel de control
    </a>

    <ul class="nav justify-content-end">
      <li class="nav-item class2">
        <a class="nav-link" style="color: white;" href="../cses.php">Cerrar sesion</a>
      </li>
    </ul>
  </nav>
  <header>Modificar Producto</header>
  <?php if ($resultado && $resultado->num_rows > 0) : ?>
    <form id="form" action="../../listar_productos.php" method="POST" class="topBefore">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>
      <input name="cantidad" type="number"  value="<?php echo $cantidad; ?>">
      <input  name="precio" type="number"  value="<?php echo $precio; ?>">
      <textarea  name="descripcion" ><?php echo $descripcion; ?></textarea>
      <input id="submit" type="submit" name="editar" value="Editar">


    </form>
  <?php else : ?>
    <p>No se encontró información con el ID proporcionado.</p>
  <?php endif; ?>
  <a href="#" onclick="history.go(-1);return false;">Regresar</a>
</body>

</html>