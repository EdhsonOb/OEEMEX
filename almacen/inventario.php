<?php
session_start();

include "../conectarbd.php";
$sql = "SELECT * FROM producto";
$resultado = $conn->query($sql);


$_SESSION['pagina_actual'] = 'inventario';


// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
  header('Location: index.html');
  exit;
}

// Verificar si el usuario está intentando acceder a una página que no le corresponde
if ($_SESSION['tipo_usuario'] == 'almacen' && basename($_SERVER['PHP_SELF']) == 'archivo.php') {
  header('Location: almacen.php');
  exit;
}

if ($_SESSION['tipo_usuario'] == 'archivos' && basename($_SERVER['PHP_SELF']) == 'almacen.php') {
  header('Location: archivo.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../cssv2/inventario.css">
  <title>Inventario</title>
</head>

<body>
  <div class="boton">


    <table>
      <tr>
        <th class="titulos">ID</th>
        <th class="titulos">Nombre</th>
        <th class="titulos">Descripcion</th>
        <th class="titulos">Precio</th>
        <th class="titulos">Cantidad</th>
        <th class="titulos">Opciones</th>
      </tr>
      <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
          <td class="datos"><?php echo $fila["id"]; ?></td>
          <td class="datos"><?php echo $fila["nombre"]; ?></td>
          <td class="datos"><?php echo $fila["descripcion"]; ?></td>
          <td class="datos"><?php echo $fila["precio"]; ?></td>
          <td class="datos"><?php echo $fila["cantidad"]; ?></td>
          <td class="datos">
            <a href="..\almacen\inventario\calar.php?id=<?php echo $fila['id']; ?>">
              <img class="img-boton" src="../img/editar.png" alt="">
            </a>
            <form method="POST" action="../listar_productos.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
              <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
              <button type="submit" name="borrar"><img class="img-boton" src="../img/eliminar.png" alt=""></button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </table>
    <a href="..\almacen\inventario\agregar.php"><img src="../img/agregar.png" alt=""></a>







</body>

</html>