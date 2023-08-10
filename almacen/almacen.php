<?php
include "../bd/conectarbd.php";
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

        .custom-alert-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .custom-alert {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        padding: 20px;
        text-align: center;
    }

    .custom-alert h3 {
        margin: 0;
        font-size: 24px;
        color: #dc3545;
    }

    .custom-alert p {
        margin: 15px 0;
        font-size: 18px;
        color: #212529;
    }

    .custom-alert ul {
        list-style: none;
        padding: 0;
        margin: 0;
        font-size: 16px;
        text-align: left;
    }

    .custom-alert ul li {
        margin: 5px 0;
        color: #6c757d;
        font-weight: bold; /* Agregar estilo en negrita */
    }

    .close-button {
        background-color: #dc3545;
        border: none;
        border-radius: 10px;
        color: white;
        padding: 7px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .custom-alert ul li span {
        color: #000; /* Cambiar color de las variables */
    }

    .close-button:hover {
        background-color: #c82333;
    }
    .boton{
        visibility: hidden;
    }
    .custom-alert ul li strong {
        color: #000; /* Cambiar color de texto en negrita */
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img style="margin-left: 5%; margin-right: 2%;" src="../img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Panel
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
                    $sql = "SELECT * FROM producto WHERE cantidad < 100";
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
    </div>
    <div class="sliderbar " id="slider">
        <div id="menu">
            <ul>
                <li class="menuz"><a href="paneldecontrol.php" class="menuv" style="text-decoration: none;">Panel de control</a></li>
                <li class="menuz"><a href="inventario.php" class="menuv" style="text-decoration: none;">Inventario</a></li>
                <li class="menuz"><a href="registro.php" class="menuv" style="text-decoration: none;">Registro</a></li>
                <li class="menuz"><a href="productos.php" class="menuv" style="text-decoration: none;">Cantidad de productos</a></li>
                <li class="menuz"><a href="faq.php" class="menuv" style="text-decoration: none;">preguntas frecuentes</a></li>
            </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Inicializar DataTables
        $('#tabla-productos1').DataTable({
            "paging": true,
            "pageLength": 8,
            "lengthMenu": [5, 10, 15]
        });

        // Obtener todos los elementos de la tabla que tengan cantidad menor a 100
        const filas = document.querySelectorAll("#tabla-productos1 tbody tr");
        const productosMenor100 = [];

        filas.forEach(function(fila) {
            const cantidad = parseInt(fila.querySelector("td:nth-child(3)").textContent);
            if (cantidad < 100) {
                const id = fila.querySelector("td:nth-child(1)").textContent;
                const nombre = fila.querySelector("td:nth-child(2)").textContent;
                productosMenor100.push({
                    id,
                    nombre,
                    cantidad
                });
            }
        });

        // Mostrar una alerta si hay productos con cantidad menor a 100
        if (productosMenor100.length > 0) {
            const alertContainer = document.createElement("div");
            alertContainer.className = "custom-alert-overlay";

            const alertContent = document.createElement("div");
            alertContent.className = "custom-alert";

            const alertHeader = document.createElement("h3");
            alertHeader.textContent = "¡Atención!";
            alertContent.appendChild(alertHeader);

            const alertText = document.createElement("p");
            alertText.textContent = "Se han encontrado productos con cantidad menor a 100:";
            alertContent.appendChild(alertText);

            const productList = document.createElement("ul");
            productosMenor100.forEach(function(producto) {
                const listItem = document.createElement("li");
                listItem.innerHTML = `<strong>ID:</strong> <span>${producto.id}</span>, <strong>Nombre:</strong> <span>${producto.nombre}</span>, <strong>Cantidad:</strong> <span>${producto.cantidad}</span>`;
                productList.appendChild(listItem);
            });
            alertContent.appendChild(productList);

            const closeButton = document.createElement("button");
            closeButton.className = "close-button";
            closeButton.textContent = "Aceptar";
            closeButton.addEventListener("click", function() {
                document.body.removeChild(alertContainer);
            });
            alertContent.appendChild(closeButton);

            alertContainer.appendChild(alertContent);
            document.body.appendChild(alertContainer);
        }
    });
    </script>
    <script>
        const slider = document.getElementById("slider");
        const toggleButton = document.getElementById("toggleButton");

        // Función para mostrar u ocultar el slider al hacer clic en el botón
        toggleButton.addEventListener("click", function() {
            const sliderVisible = slider.style.left === "0px";
            slider.style.left = sliderVisible ? "-600px" : "0px";
        });
    </script>

    <script src="../js/opcpanelcontrol.js"></script>

</body>

</html>