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

// Obtén los datos de la base de datos para cada categoría
$sqlMenor250 = "SELECT COUNT(*) as cantidad FROM producto WHERE cantidad < 250";
$sqlEntre250y750 = "SELECT COUNT(*) as cantidad FROM producto WHERE cantidad >= 250 AND cantidad < 750";
$sqlMayor750 = "SELECT COUNT(*) as cantidad FROM producto WHERE cantidad >= 750";

$resultMenor250 = $conn->query($sqlMenor250)->fetch_assoc();
$resultEntre250y750 = $conn->query($sqlEntre250y750)->fetch_assoc();
$resultMayor750 = $conn->query($sqlMayor750)->fetch_assoc();

$data = [
    "Menor a 250" => $resultMenor250["cantidad"],
    "Entre 250 y 750" => $resultEntre250y750["cantidad"],
    "Mayor a 750" => $resultMayor750["cantidad"]
];
//echo json_encode($data);
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="shortcut icon" href="../img/logo1.png" type="image/x-icon">
            <title>Panel de control</title>
    <style>

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
    <div id="myChartContainer" style="height: 50vh;">
        <canvas id="myChart"></canvas>
    </div>
    
    <script>
    // Crear el gráfico con los datos obtenidos
    const ctx = document.getElementById("myChart").getContext("2d");
    const labels = <?php echo json_encode(array_keys($data)); ?>;
    const valores = <?php echo json_encode(array_values($data)); ?>;
    
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Cantidad de Productos",
                data: valores,
                backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f"],
                borderColor: "rgba(54, 162, 235, 0.2)",
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
                        color: "#eee"
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
                    text: "Cantidad de Productos por Categoría",
                    font: {
                        family: 'Arial',
                        size: 16,
                        weight: 'bold'
                    }
                },
            },
        },
    });
</script>

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