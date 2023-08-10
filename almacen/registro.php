<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../bd/conectarbd.php";
$sql = "SELECT * FROM producto";
$resultado = $conn->query($sql);

$_SESSION['pagina_actual'] = 'inventario';

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: ../index.html');
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
    <link rel="shortcut icon" href="../img/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../cssv2/inventario.css">
    <link rel="stylesheet" href="../cssv2/almacen.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Gestor de almacén</title>
    <style>
        #sidebar-nav {
            width: 160px;
        }

        #toggleButton {
            position: fixed;
            visibility: hidden;
            top: 15px;
            right: 15px;
            z-index: 1001;
            color: white;
            background-color: transparent;
            border: none;
            font-size: 24px;
        }

        @media (max-width: 950px) {

            #toggleButton {
                position: fixed;
                visibility: visible;
                top: 10px;
                right: 15px;
                z-index: 1001;
                color: white;
                background-color: transparent;
                border: none;
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img style="margin-left: 5%; margin-right: 2%;" src="../img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Registro
        </a>

        <ul class="nav justify-content-end">
            <li class="nav-item class2">
                <a class="nav-link" style="color: white;" href="../bd/cses.php">Cerrar sesion</a>
            </li>
            <li class="nav-item class2"> <button id="toggleButton">&#9776;</button></li>
        </ul>
    </nav>


    <div class="contenido-menu" id="contenido">
        <div class="boton">
            <table id="tabla-productos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario de Modificación</th>
                        <th>Fecha de Modificación</th>
                    </tr>
                </thead>
                <tbody id="cuerpo-tabla">
                    <?php while ($fila = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td id="id" class="one-color"><?php echo $fila["id"]; ?></td>
                            <td class=""><?php echo $fila["nombre"]; ?></td>
                            <td><?php echo $fila["usuario_modificacion"]; ?></td>
                            <td><?php echo $fila["fecha_modificacion"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        </div>


        <div class="sliderbar" id="slider">
            <div id="menu">
                <ul>
                    <li class="menuz"><a href="paneldecontrol.php" class="menuv" style="text-decoration: none;">Panel de control</a></li>
                    <li class="menuz"><a href="inventario.php" class="menuv" style="text-decoration: none;">inventaro</a></li>
                    <li class="menuz"><a href="productos.php" class="menuv" style="text-decoration: none;">Cantidad de productos</a></li>
                    <li class="menuz"><a href="faq.php" class="menuv" style="text-decoration: none;">Preguntas frecuentes</a></li>
                </ul>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
        <script>
            const slider = document.getElementById("slider");
            const toggleButton = document.getElementById("toggleButton");

            // Función para mostrar u ocultar el slider al hacer clic en el botón
            toggleButton.addEventListener("click", function() {
                const sliderVisible = slider.style.left === "0px";
                slider.style.left = sliderVisible ? "-600px" : "0px";
            });

            function toggleAnswer(id) {
                const answer = document.getElementById(`answer${id}`);
                answer.style.display = answer.style.display === 'flex' ? 'none' : 'flex';
            }
            // Esperar a que el DOM esté completamente cargado
            document.addEventListener("DOMContentLoaded", function() {
                // Inicializar DataTables
                $('#tabla-productos').DataTable({
                    "paging": true, // Habilitar la paginación
                    "pageLength": 8, // Número de resultados por página
                    "lengthMenu": [5, 10, 15], // Aquí puedes configurar más opciones según tus necesidades
                    // Consulta la documentación de DataTables para ver todas las opciones disponibles.
                });
            });
        </script>




 

</body>

</html>