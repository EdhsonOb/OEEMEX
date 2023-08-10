<?php
// Obtener el parámetro "tabla" de la URL
if (isset($_GET['tabla'])) {
    $tabla = $_GET['tabla'];
    
    // Asegurarse de que $tabla sea uno de los valores permitidos (por ejemplo: tabla-productos1, tabla-productos2, tabla-productos3)
    // Esto es importante para evitar posibles problemas de seguridad.
    
    // Consulta y generación de CSV específicos para cada tabla
    include "../bd/conectarbd.php";
    $sql = "";
    if ($tabla === "tabla-productos1") {
        $sql = "SELECT * FROM producto WHERE cantidad < 250";
    } elseif ($tabla === "tabla-productos2") {
        $sql = "SELECT * FROM producto WHERE cantidad > 250 AND cantidad < 750";
    } elseif ($tabla === "tabla-productos3") {
        $sql = "SELECT * FROM producto WHERE cantidad > 750";
    }
    
    $resultado = $conn->query($sql);

    // Verificar si hay datos en el resultado
    if ($resultado->num_rows > 0) {
        // Establecer las cabeceras para descargar el archivo CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="reporte_'.$tabla.'.csv"');

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
} else {
    // Si no se proporciona el parámetro "tabla" en la URL, mostrar un mensaje o redirigir a otra página.
    echo "Tabla no especificada.";
}
?>
