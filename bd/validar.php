<?php
session_start();
include "conectarbd.php";

$username = $_POST['user'];
$password = $_POST['password'];

$sql = "SELECT id, tipo_usuario, username FROM usuarios WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

// Si el usuario y contraseña son válidos
if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();

  // Crear una variable de sesión con el tipo de usuario
  $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
  $_SESSION['username'] = $row['username'];
  $nombre_usuario = $row['username'];

  // Redirigir según el tipo de usuario
  if ($row['tipo_usuario'] == 'admin') {
    header('Location: ../menu.php');
    exit ();
  } elseif ($row['tipo_usuario'] == 'almacen') {
    header('Location: ../almacen/almacen.php');
    exit ();
  } elseif ($row['tipo_usuario'] == 'archivos') {
    header('Location: ../archivo.php');
    exit ();
  }
} else {
  // Si el usuario y contraseña no son válidos, redirigir al formulario de inicio de sesión
  header('Location: index.php?error=1');
}
ob_end_flush(); // Enviar salida al navegador
?>








