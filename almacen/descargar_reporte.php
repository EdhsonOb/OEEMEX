<?php
// Incluir archivo para conectar a la base de datos
include "../bd/conectarbd.php";

// Realizar consulta a la base de datos para obtener los datos del inventario
$sql = "SELECT * FROM producto";
$resultado = $conn->query($sql);

// Verificar si hay datos en el resultado
if ($resultado->num_rows > 0) {
    // Establecer las cabeceras para descargar el archivo CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="reporte.csv"');

    // Crear un archivo temporal para almacenar los datos CSV
    $archivo_temporal = fopen('php://output', 'w');

    // Escribir los encabezados de la tabla en el archivo CSV
    $encabezados = array('ID', 'Nombre', 'Descripción', 'Precio', 'Cantidad');
    fputcsv($archivo_temporal, $encabezados);

    // Obtener los datos del inventario y escribirlos en el archivo CSV
    while ($fila = $resultado->fetch_assoc()) {
        $datos = array(
            $fila["id"],
            $fila["nombre"],
            $fila["descripcion"],
            $fila["precio"],
            $fila["cantidad"]
        );
        fputcsv($archivo_temporal, $datos);
    }
    

    // Cerrar el archivo temporal
    fclose($archivo_temporal);
    exit;
} else {
    // Si no hay datos en el inventario, mostrar un mensaje o redirigir a otra página
    echo "No hay datos en el inventario.";
}


?>