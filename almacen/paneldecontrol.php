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

    <link rel="shortcut icon" href="../img/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../cssv2/almacen.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js%22%3E"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js%22%3E"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="shortcut icon" href="../img/logo1.png" type="image/x-icon">
            <title>Panel de control</title>
            <style>
                table {
                    font-family: Arial, sans-serif;
                    border-collapse: collapse;
                    width: 300px;
                    margin: 20px;
                }

                th {
                    background-color: #f2f2f2;
                    text-align: left;
                    padding: 8px;
                }

                td {
                    padding: 8px;
                }

                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }

                #myChartContainer {
                    position: relative;
                    width: 600px;
                    height: 400px;
                    margin: 20px;
                }

                #myChart {
                    position: absolute;
                    top: 0;
                    left: 0;
                }
            </style>
    <style>
        /* body {
            background-color: white;
        }

        .titulo {
            background-color: deepskyblue;
            width: 100%;
            height: 100%;
            position: relative;
        }

        ul,
        li,
        a {
            list-style: none;
            text-decoration: none;
        }

        .menuv {
            color: white;
        }

        #menu {
            background-color: rgb(0, 110, 255);
            width: 12%;
            min-height: 95.6vh;
        }

        .menuz {
            padding-top: 55px;
        }

        #sidebar {
            float: left;
            width: 20%;
            height: 100%;
            background-color: white;
            padding: 20px;
            width: 100vh;
        }

        .contenido-menu {
            float: right;
            width: 88%;
            height: 200%;
            padding: 20px;
            background-color: white;
            z-index: 10;
        }

        /* Agregado para la sliderbar */
        #sliderbar {
            position: fixed;
            top: 0;
            left: -200px;
            width: 200px;
            height: 100vh;
            background-color: rgb(0, 110, 255);
            transition: left 0.3s;
            z-index: 999;
        }

        #menu-icon {
            position: fixed;
            top: 50px;
            left: 20px;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        #menu-content {
            padding: 20px;
        }

        .show-menu {
            left: 0;
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

<body id="body-pd">

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img style="margin-left: 5%; margin-right: 2%;" src="../img/logo1.png" width="30" height="30"
                class="d-inline-block align-top" alt="">
                Panel de control
        </a>

        <ul class="nav justify-content-end">
            <li class="nav-item class2">
                <a class="nav-link" style="color: white;" href="../bd/cses.php">Cerrar sesion</a>
            </li>
            <li class="nav-item class2">  <button id="toggleButton">&#9776;</button></li>
        </ul>
    </nav>

   
    


        <div class="contenido-menu" id="contenido">

<div id="myChartContainer">
    <canvas id="myChart"></canvas>
</div>

<table id="myTable">
    <thead>
        <tr>
            <th>Mes</th>
            <th>Ventas</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Enero</td>
            <td>50</td>
        </tr>
        <tr>
            <td>Febrero</td>
            <td>100</td>
        </tr>
        <tr>
            <td>Marzo</td>
            <td>-100</td>
        </tr>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const table = document.getElementById("myTable");
        const ctx = document.getElementById("myChart").getContext("2d");

        // Extrae los datos de la tabla
        const labels = [];
        const data = [];

        const rows = table.getElementsByTagName("tr");
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            labels.push(cells[0].textContent);
            data.push(parseInt(cells[1].textContent));
        }

        // Crea el gráfico con Chart.js
        const chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Ventas",
                    data: data,
                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f"],
                    borderColor: "#000",
                    borderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Arial',
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: "#ddd"
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 50,
                            font: {
                                family: 'Arial',
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: "Ventas por mes",
                        font: {
                            family: 'Arial',
                            size: 16,
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    });
</script>
</div>
    </div>

    <div class="sliderbar" id="slider">
    <div id="menu">
        <ul>
            <li class="menuz"><a href="inventario.php" class="menuv" style="text-decoration: none;" >inventaro</a></li>
            <li class="menuz"><a href="registro.php" class="menuv" style="text-decoration: none;" >Registro</a></li>
            <li class="menuz"><a href="productos.php" class="menuv" style="text-decoration: none;" >Cantidad de productos</a></li>
            <li class="menuz"><a href="faq.php" class="menuv" style="text-decoration: none;" >Preguntas frecuentes</a></li>
        </ul>
    </div>
    </div>

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

   
    </script>

</body>

</html>







