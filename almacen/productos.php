<?php
include "../bd/conectarbd.php";
// Obtener los datos de los productos


?>

<?php
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: ../index.html');
    exit;
}

// Verificar si el usuario está intentando acceder a una página que no le corresponde
if ($_SESSION['tipo_usuario'] == 'almacen' && basename($_SERVER['PHP_SELF']) == 'archivo.php') {
    header('Location: ../../almacen.php');
    exit;
}

if ($_SESSION['tipo_usuario'] == 'archivos' && basename($_SERVER['PHP_SELF']) == 'almacen.php') {
    header('Location: ../../archivo.php');
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
    <link rel="stylesheet" href="../cssv2/almacen.css">
    <link rel="stylesheet" href="../cssv2/inventario.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Gestor de almacén</title>
    <style>
        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: -0.em;
            display: inline-block;
            width: 100px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .boton {
            display: inline-block;
            margin-right: 20px;
            vertical-align: top;
        }

        /* Aplicar estilos personalizados al campo de búsqueda */
        .dataTables_wrapper .dataTables_filter input {
            width: 100px;
            /* Ajusta el ancho según tus necesidades */
            padding: 5px;
            /* Ajusta el espaciado interno según tus necesidades */
            font-size: 12px;
            /* Ajusta el tamaño de fuente según tus necesidades */
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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

            .boton {
                width: 100%;
                
            }

            .pnombre {
                width: 100%;
            }

            .contenido-menu {
                display: grid;
                grid-gap: 40px;
            }

            .title {
                font-size: 15px;
            }

            .nav-link {
                font-size: 12.5px;
            }

            div.dataTables_wrapper div.dataTables_filter input {
                margin-left: -0.em;
                display: inline-block;
                width: 100px;
            }
        }

        .report {
            margin-top: 5px;
            margin-bottom: 5px;
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
        }

        #id {
            width: 10px;

        }

        .cantidad {
            width: 100%;
    display: inline-block;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    padding: 8px 12px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s, color 0.3s;
    text-align: center;
}

.red {
    color: #d9534f; /* Rojo */
    background-color: #f9d6d5; /* Rosa claro */
    border-bottom: 2px solid #d9534f;
}.rojo {
    border-radius: 5px;
    border: 2px solid #d9534f;
}

.yellow {
    color: #f0ad4e; /* Amarillo dorado */
    background-color: #fcf3d9; /* Amarillo claro */
    border-bottom: 2px solid #f0ad4e;
}.amarillo {
    border-radius: 5px;
    border: 2px solid #f0ad4e;
}

.verde {
    color: #5cb85c; /* Verde */
    background-color: #d4edda; /* Verde claro */
    border-bottom: 2px solid #5cb85c;
}.green {
    border-radius: 5px;
    border: 2px solid #5cb85c;
}


.cantidad:hover {
    background-color: #f0f0f0;
    color: #333;
}
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img style="margin-left: 5%; margin-right: 2%;" src="../img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <label class="title">Cantidad de productos</label>
        </a>

        <ul class="nav justify-content-end">
            <li class="nav-item class2">
                <a class="nav-link" style="color: white;" href="../bd/cses.php">Cerrar sesion</a>
            </li>
            <li class="nav-item class2"> <button id="toggleButton">&#9776;</button></li>
        </ul>
    </nav>

    <div class="contenido-menu" id="contenido">
        <div class="boton rojo">
            <label class="cantidad red" for="cantidad">Cantidad menor a 250</label>
            <table id="tabla-productos1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="pnombre">Nombre</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody id="cuerpo-tabla">
                    <?php
                    $sql = "SELECT * FROM producto WHERE cantidad < 249";
                    $resultado = $conn->query($sql);
                    while ($fila = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td id="id red" class="one-color"><?php echo $fila["id"]; ?></td>
                            <td class="nombre"><?php echo $fila["nombre"]; ?></td>
                            <td id="id"><?php echo $fila["cantidad"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="boton btns">
                <div class="report"> <a href="descargar_reporte_tablas.php?tabla=tabla-productos1" class="buttonDownload">Descargar Reporte</a>
                </div>
            </div>
        </div>

        <div class="boton amarillo">
            <label class="cantidad yellow" for="cantidad">Cantidad mayor a 250 y menor a 750</label>
            <table id="tabla-productos2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="pnombre">Nombre</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody id="cuerpo-tabla">
                    <?php
                    $sql = "SELECT * FROM producto WHERE  cantidad >= 250 AND cantidad < 750";
                    $resultado = $conn->query($sql);
                    while ($fila = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td id="id" class="one-color"><?php echo $fila["id"]; ?></td>
                            <td class="nombre"><?php echo $fila["nombre"]; ?></td>
                            <td id="id"><?php echo $fila["cantidad"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="boton btns">
                <div class="report"> <a href="descargar_reporte_tablas.php?tabla=tabla-productos2" class="buttonDownload">Descargar Reporte</a>
                </div>
            </div>
        </div>

        <div class="boton green">
            <label class="cantidad verde" for="cantidad">Cantidad mayor a 750</label>
            <table id="tabla-productos3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="pnombre">Nombre</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody id="cuerpo-tabla">
                    <?php
                    $sql = "SELECT * FROM producto WHERE cantidad >= 750";
                    $resultado = $conn->query($sql);
                    while ($fila = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td id="id" class="one-color"><?php echo $fila["id"]; ?></td>
                            <td class="nombre"><?php echo $fila["nombre"]; ?></td>
                            <td id="id"><?php echo $fila["cantidad"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="boton btns">
                <div class="report"> <a href="descargar_reporte_tablas.php?tabla=tabla-productos1" class="buttonDownload">Descargar Reporte</a>
                </div>
            </div>
        </div>
    </div>

    <div class="sliderbar" id="slider">
        <div id="menu">
            <ul>
                <li class="menuz"><a href="paneldecontrol.php" class="menuv" style="text-decoration: none;">Panel de control</a></li>
                <li class="menuz"><a href="inventario.php" class="menuv" style="text-decoration: none;">inventaro</a></li>
                <li class="menuz"><a href="registro.php" class="menuv" style="text-decoration: none;">Registro</a></li>
                <li class="menuz"><a href="faq.php" class="menuv" style="text-decoration: none;">Preguntas frecuentes</a></li>
            </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    <script>
        // Esperar a que el DOM esté completamente cargado
        document.addEventListener("DOMContentLoaded", function() {
            // Inicializar DataTables
            $('#tabla-productos1').DataTable({
                "paging": true,
                "pageLength": 8,
                "lengthMenu": [5, 10, 15]
            });

            // Inicializar DataTables para la tabla-productos2
            $('#tabla-productos2').DataTable({
                "paging": true,
                "pageLength": 8,
                "lengthMenu": [5, 10, 15]
            });

            // Inicializar DataTables para la tabla-productos3
            $('#tabla-productos3').DataTable({
                "paging": true,
                "pageLength": 8,
                "lengthMenu": [5, 10, 15]
            });
        });
        $(document).ready(function() {
            $('#tabla-productos1').DataTable();
            $('#tabla-productos2').DataTable();
            $('#tabla-productos3').DataTable();
        });
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
    </script>
</body>

</html>