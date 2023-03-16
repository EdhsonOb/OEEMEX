<?php

if($_POST['btnEnviar']){

    $Ruta = $_POST['txtCarpeta'];


    if(!file_exists('Usuarios/'.$Ruta.'')){

        mkdir('Usuarios/'.$Ruta.'',0777,true);
        echo "se creo la carpeta exitosamente";
        }else{
            echo "ya existia";
        }
        
}

?>