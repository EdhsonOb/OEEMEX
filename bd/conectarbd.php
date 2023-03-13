<?php
$servername = "proyectosinformaticatnl.ceti.mx";
$username = "solidcompone";
$password = "999f6f895";
$dbname = "solidcompone";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>