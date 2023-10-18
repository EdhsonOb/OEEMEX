<?php
session_start();
include "../bd/conectarbd.php";


// Consulta SQL con LIMIT y OFFSET
$sql = "SELECT * FROM producto";
$resultado = $conn->query($sql);

// Obtener el número total de registros
$sql_total = "SELECT COUNT(*) AS total FROM producto";
$resultado_total = $conn->query($sql_total);
$total_registros = $resultado_total->fetch_assoc()['total'];

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: ../index.html');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../cssv2/almacen.css">
    <link rel="stylesheet" href="../cssv2/inventario.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img style="margin-left: 5%; margin-right: 2%;" src="../img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Inventario
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
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th class="arch">Archivo de referencia</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="cuerpo-tabla">
                    <?php while ($fila = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td id="id" class="one-color"><?php echo $fila["id"]; ?></td>
                            <td class=""><?php echo $fila["nombre"]; ?></td>
                            <td class="one-color"><?php echo $fila["descripcion"]; ?></td>
                            <td class="">$<?php echo $fila["precio"]; ?></td>
                            <td id="cantidad_<?php echo $fila['id']; ?>" class="one-color"><?php echo $fila["cantidad"]; ?></td>
                            <td class="link" id="link">
                                <?php
                                $nombre_dato = $fila["nombre"];
                                $archivos = scandir("../almacen/inventoryfiles");
                                foreach ($archivos as $archivo) {
                                    if ($archivo != "." && $archivo != "..") {
                                        // Verificar si el nombre del archivo contiene el nombre del dato
                                        if (strpos($archivo, $nombre_dato . "_") === 0) {
                                ?>
                                            <a href="../almacen/inventoryfiles/<?php echo $archivo; ?>"><button class="buttonDownload">Descargar</button></a>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td class="op">
                                <div class="botones">
                                    <a href="../almacen/inventario/calar.php?id=<?php echo $fila['id']; ?>" class="editar">
                                        <img id="opciones" class="img-boton" src="../img/editar.png" alt="">
                                    </a>
                                    <a href="#" class="editar" onclick="abrirModalActualizar(<?php echo $fila['id']; ?>, <?php echo $fila['cantidad']; ?>)">
    <img id="opciones" class="img-boton" src="../img/actualizar.png" alt="">
</a>
                                    <form class="frmdelete" method="POST" action="../listar_productos.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                                        <button class="button-delete" type="submit" name="borrar"><img id="opciones" class="img-boton" src="../img/eliminar.png" alt=""></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div id="modalActualizar" style="display: none;">
    <form id="formularioActualizar">
        <label for="cantidadEliminar">Cantidad a eliminar:</label>
        <input type="number" id="cantidadEliminar" name="cantidadEliminar" required>
        <input type="hidden" id="productoId" name="productoId">
        <input type="hidden" id="cantidadActual" name="cantidadActual">
        <button type="button" onclick="eliminarCantidad()">Actualizar</button>
    </form>
</div>
        </div>

        <div class="boton btns">
            <div class="report"><a href="descargar_reporte.php" class="buttonDownload">Descargar Reporte</a>
            </div>
            <div class="report"><a class="agregar" href="..\almacen\inventario\agregar.php"><img src="../img/agregar.png" alt=""></a></div>
        </div>
    </div>
    <!-- display: flex;
justify-content: space-between;
align-items: center; -->

    <div class="sliderbar" id="slider">
        <div id="menu">
            <ul>
                <li class="menuz"><a href="paneldecontrol.php" class="menuv" style="text-decoration: none;">Panel de control</a></li>
                <li class="menuz"><a href="registro.php" class="menuv" style="text-decoration: none;">Registro</a></li>
                <li class="menuz"><a href="productos.php" class="menuv" style="text-decoration: none;">Cantidad de productos</a></li>
                <li class="menuz"><a href="faq.php" class="menuv" style="text-decoration: none;">Preguntas frecuentes</a></li>
            </ul>
        </div>
    </div>

    <script src="../js/opcpanelcontrol.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    <script>
        function abrirModalActualizar(id, cantidadActual) {
    document.getElementById("productoId").value = id;
    document.getElementById("cantidadActual").value = cantidadActual;
    document.getElementById("modalActualizar").style.display = "block";
}
function eliminarCantidad() {
    const cantidadEliminar = parseInt(document.getElementById("cantidadEliminar").value);
    const productoId = parseInt(document.getElementById("productoId").value);
    const cantidadActual = parseInt(document.getElementById("cantidadActual").value);

    const nuevaCantidad = cantidadActual - cantidadEliminar;

    // Realizar la actualización en la base de datos utilizando AJAX
    $.ajax({
        type: "POST",
        url: "../listar_productos.php", // Cambia esto por la ruta a tu script PHP de actualización
        data: { id: productoId, cantidad: nuevaCantidad },
        success: function(response) {
            // Actualizar la cantidad en la tabla sin recargar la página
            const cantidadColumna = document.querySelector(`#cantidad_${productoId}`);
            cantidadColumna.textContent = nuevaCantidad;

            // Cierra el modal
            document.getElementById("modalActualizar").style.display = "none";
        },
        error: function() {
            alert("Error al actualizar la cantidad en la base de datos.");
        }
    });
}
    </script>
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