<?php
//aqui estamos cerrando la sesion cuando le pique al boton de cerrar sesion
session_start();
session_destroy();
echo'<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.html">';

?>