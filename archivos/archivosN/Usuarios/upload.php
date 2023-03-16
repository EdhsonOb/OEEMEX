<?php
if($_POST['btnEnviar']){
$file_name = $_FILES['file']['name'];
$file_tmp =$_FILES['file']['tmp_name'];
//$ruta = $_POST['txtCarpeta'];
$carpeta = "Usuarios/";
$movefile = move_uploaded_file($file_tmp, $carpeta .$_file_name);
if($movefile){
    echo "El archivo se movio con exito";
}
}
?>  


