<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form  method="POST" enctype="multipart/form-data">
        <h2>Subir archivos</h2>
        <input type="file" name="file">
        <p>    
            <label>Nombre de la Carpeta</label>
            <input type="text" name="txtCarpeta">
            </p>
        <p class="center"><input type="submit" value="Subir archivo"></p>
    </form>
    
</body>

</html>

<?php
if(isset($_FILES['file'])){
$file_name = $_FILES['file']['name'];
$file_tmp =$_FILES['file']['tmp_name'];
$ruta = $_POST['txtCarpeta'];
$carpeta = 'Usuarios/'.$ruta.'/';
$movefile = move_uploaded_file($file_tmp, $carpeta .$file_name);
if($movefile){
    echo "El archivo se movio con exito";
}
}
?>  
