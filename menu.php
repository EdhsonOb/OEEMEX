<?php
session_start();

// Verificar que el usuario haya iniciado sesión y sea del tipo "admin"
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'admin') {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="cssv2/menu.css">
    <link rel="shortcut icon" href="img/logo1.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Menu de opciones</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img src="img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <h4 style="color: red">Menu</h4>
        </a>
        <ul class="nav justify-content-end">
            <li class="nav-item class2">
                <a class="nav-link" style="color: white;" href="cses.php">Cerrar sesion</a>
            </li>
        </ul>
    </nav>

    <div class="card-deck">
        <div class="cards">
            <div class="card-img"> <img id="textin" class="card-img-top partebaja" src="img/archivo2.png" alt="Card image cap"></div>
            <div class="card-info">
                <div class="card-text">
                    <p class="text-title">Gestor de archivos</p>
                    <p class="text-subtitle">Aqui podras subir tus archivos, ver el de los demas y descargar archivos.</p>
                </div>
                <div class="card-icon">
                    <a href="archivos/filesAdmin.php">                    
                        <svg viewBox="0 0 28 25">
                            <path d="M13.145 2.13l1.94-1.867 12.178 12-12.178 12-1.94-1.867 8.931-8.8H.737V10.93h21.339z"></path>
                        </svg>
                    </a>

                </div>
            </div>
        </div>
        <div class="cards">
            <div class="card-img"><img id="textin" class="card-img-top partebaja" src="img/inventarioV2.png" alt="Card image cap"></div>
            <div class="card-info">
                <div class="card-text">
                    <p class="text-title">Inventario de almacen</p>
                    <p class="text-subtitle">Aqui podras ver y administrar el inventario</p>
                </div>
                <div class="card-icon">
                    <a href="almacen/almacen.php">
                        <svg viewBox="0 0 28 25">
                            <path d="M13.145 2.13l1.94-1.867 12.178 12-12.178 12-1.94-1.867 8.931-8.8H.737V10.93h21.339z"></path>
                        </svg>
                    </a>

                </div>
            </div>
        </div>



        </div>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>