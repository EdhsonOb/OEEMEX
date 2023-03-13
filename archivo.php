<?php
session_start();

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
<html>
<head>
    <title>File Upload Example</title>
</head>
<body>
<a href="cses.php">cerrar sesion</a>
    <h1>File Upload Example</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="submit" value="Upload">
    </form>
    <br>
    <hr>
    <h2>File List</h2>
    <?php include 'file_list.php'; ?>
</body>
</html>