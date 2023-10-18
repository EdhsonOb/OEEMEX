<?php
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "bd/conectarbd.php";
$usuario_actual = $_SESSION['username'];
if (!$usuario_actual) {
    die("Error: no se ha proporcionado el usuario actual");
  }
 
// Comprobar si se ha enviado el formulario para actualizar la base de datos
//! este if isset sirve para agregar los datos
$target_dir = "almacen/inventoryfiles/"; // cambia esto por la ruta a tu carpeta de almacenamiento
if(isset($_POST['agregar'])){
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];
    // Genera un nombre de archivo único
    $nombre_archivo = "";
    if (isset($_FILES["file"]["name"])) {
        $nombre_archivo = $_POST['nombre'] . "_" . basename($_FILES["file"]["name"]);
        $target_file = $target_dir . $nombre_archivo;
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    }
    // Actualizar los datos en la base de datos
    $stmt = $conn->prepare("INSERT INTO producto (nombre, descripcion, cantidad, precio, usuario_modificacion, fecha_modificacion) VALUES (?, ?, ?, ?, ?, NOW())"); 
    //En lugar de colocar los valores de los campos directamente en la consulta SQL, se utiliza un marcador de posición "?", lo que indica que se esperan valores en su lugar. Luego, los valores reales se establecen utilizando el método "bind_param()", que vincula los valores de los parámetros con los marcadores de posición en la consulta SQL.
    $stmt->bind_param("ssids", $nombre, $descripcion, $cantidad, $precio, $usuario_actual);
    if ($stmt->execute()) {
        echo "<script>
        alert('Datos agregados correctamente');
        window.location.href = 'almacen/inventario/agregar.php';
    </script>";
        
    exit();
    } else {
        echo "Error al agregar datos: " . $stmt->error;
    }
}
//! este if isset sirve para editar los datos
if(isset($_POST['editar'])){
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];

  // Obtener la cantidad actual del producto
  // $stmt_select = $conn->prepare("SELECT cantidad FROM producto WHERE id=?");
  // $stmt_select->bind_param("i", $id);
  // $stmt_select->execute();
  // $stmt_select->bind_result($cantidad_anterior);
  // $stmt_select->fetch();

  // Actualizar los datos en la base de datos
  $stmt = $conn->prepare("UPDATE producto SET nombre=?, descripcion=?, cantidad=?, precio=?, usuario_modificacion=?, fecha_modificacion=NOW() WHERE id=?");
  // Se debe pasar $id como el último parámetro en bind_param()
  $stmt->bind_param("ssidss", $nombre, $descripcion, $cantidad, $precio, $usuario_actual, $id);
  if ($stmt->execute()) {
      echo "<script>
      
          alert('Datos modificados correctamente');
          window.location.href = 'almacen/almacen.php';
      </script>";

      // Registro de modificación
      $stmt_registro = $conn->prepare("INSERT INTO registro_producto (id_producto, cantidad_nueva, usuario_modificacion, fecha_modificacion) VALUES (?, ?, ?, NOW())");
      $stmt_registro->bind_param("iiis", $id, $cantidad, $usuario_actual);
      $stmt_registro->execute();
  } else {
      echo "Error al actualizar datos: " . $stmt->error;
  }
}
//! este if isset sirve para borrar los datos
if(isset($_POST['borrar'])){
    $id = $_POST['id'];
  
    // Eliminar el producto de la base de datos
    $stmt = $conn->prepare("DELETE FROM producto WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      echo "<script>alert('El producto ha sido eliminado'); setTimeout(function(){window.location.href='almacen/almacen.php'}, 20);</script>";
    } else {
      echo "Error al eliminar el producto: " . $stmt->error;
    }
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["cantidad"])) {
    $id = $_POST["id"];
    $nuevaCantidad = $_POST["cantidad"];

    // Actualizar la cantidad en la base de datos
    $stmt = $conn->prepare("UPDATE producto SET cantidad = ? WHERE id = ?");
    $stmt->bind_param("ii", $nuevaCantidad, $id);

    if ($stmt->execute()) {
        echo "Cantidad actualizada correctamente.";
    } else {
        echo "Error al actualizar la cantidad: " . $stmt->error;
    }

    $stmt->close();
}

// Cerrar la conexión con la base de datos
$conn->close();
?>