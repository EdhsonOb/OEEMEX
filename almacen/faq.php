<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="../img/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../cssv2/almacen.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js%22%3E"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>FAQ - Preguntas Frecuentes</title>
    <style>

        .contenido-menu {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .faq-title {
            color: deepskyblue;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 2px;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .faq-item {
            margin-bottom: 20px;
            cursor: pointer;
            border: 2px solid deepskyblue;
            border-radius: 5px;
            padding: 10px;
            transition: background-color 0.2s;
        }

        .faq-item:hover {
            background-color: deepskyblue;
        }

        .question {
            font-weight: bold;
            font-size: 18px;
            color: #333;
            position: relative;
            padding-left: 30px;
        }

        .question::before {
            content: "+";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: white;
        }

        .answer {
            display: none;
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin-top: 10px;
            padding-left: 20px;
        }

        .answer::before {
            content: "▸";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: white;
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

<body>

    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img style="margin-left: 5%; margin-right: 2%;" src="../img/logo1.png" width="30" height="30" class="d-inline-block align-top" alt="">
            FAQ
        </a>

        <ul class="nav justify-content-end">
            <li class="nav-item class2">
                <a class="nav-link" style="color: white;" href="../bd/cses.php">Cerrar sesion</a>
            </li>
            <li class="nav-item class2">  <button id="toggleButton">&#9776;</button></li>
        </ul>
    </nav>


    <div class="contenido-menu" id="contenido">
        <div class="faq-title">Preguntas Frecuentes</div>
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(1)">¿Cómo agrego un dato a la tabla de inventario?</div>
            <div class="answer" id="answer1">Para agregar un dato a la tabla de inventario, sigue los siguientes pasos:<br>
                1. Ingresa al panel de control del sistema.<br>
                2. Haz clic en la sección de "Inventario".<br>
                3. Selecciona la opción "Agregar nuevo producto".<br>
                4. Llena los campos requeridos como nombre, descripción, precio y cantidad.<br>
                5. Guarda los cambios y el dato se agregará a la tabla de inventario automáticamente.
            </div>
        </div>
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(2)">¿Cómo edito un dato a la tabla de inventario?</div>
            <div class="answer" id="answer2">Para editar un dato en la tabla de inventario, sigue los siguientes pasos:<br>
                1. Ingresa al panel de control del sistema.<br>
                2. Accede a la sección de "Inventario".<br>
                3. Busca el producto que deseas editar en la tabla.<br>
                4. Haz clic en el botón de "Editar" correspondiente al producto.<br>
                5. Modifica los campos que desees actualizar.<br>
                6. Guarda los cambios y el dato se actualizará en la tabla de inventario.
            </div>
        </div>
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(3)">¿Cómo elimino un dato a la tabla de inventario?</div>
            <div class="answer" id="answer3">Para eliminar un dato de la tabla de inventario, sigue los siguientes pasos:<br>
                1. Ingresa al panel de control del sistema.<br>
                2. Dirígete a la sección de "Inventario".<br>
                3. Encuentra el producto que deseas eliminar en la tabla.<br>
                4. Haz clic en el botón de "Eliminar" correspondiente al producto.<br>
                5. Confirma la acción en el mensaje de confirmación que aparecerá.<br>
                6. El dato será eliminado de la tabla de inventario.
            </div>
        </div>
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(4)">¿Cómo puedo descargar el reporte de inventario?</div>
            <div class="answer" id="answer4">Para descargar el reporte de los datos del inventario, sigue los siguientes pasos:<br>
                1. Ingresa al panel de control del sistema.<br>
                2. Haz clic en la sección de "Inventario".<br>
                3. Selecciona la opción "Agregar nuevo producto".<br>
                4. Llena los campos requeridos como nombre, descripción, precio y cantidad.<br>
                5. Guarda los cambios y el dato se agregará a la tabla de inventario automáticamente.</div>
        </div>
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(5)">¿Qué tipos de archivos puedo almacenar en el sistema?</div>
            <div class="answer" id="answer5">El Sistema de Gestión de Documentos permite almacenar una amplia variedad de archivos, como documentos de texto (PDF, DOC, TXT), hojas de cálculo (XLS, CSV), presentaciones (PPT, PPTX), imágenes (JPG, PNG) y muchos otros formatos comunes.</div>
        </div>
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(6)">¿Puedo compartir documentos con otros usuarios?</div>
            <div class="answer" id="answer6">Sí, el sistema ofrece la funcionalidad de compartir documentos con otros usuarios de RedGestor. Puedes establecer permisos de acceso para cada archivo y decidir si otros usuarios pueden ver, editar o eliminar el documento..</div>
        </div>
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(7)">¿Puedo acceder al sistema desde dispositivos móviles?</div>
            <div class="answer" id="answer7">Sí, el sistema es compatible con dispositivos móviles, lo que te permite acceder y gestionar tus documentos desde cualquier lugar y en cualquier momento a través de tu smartphone o tableta.</div>
        </div>
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(8)">¿Puedo buscar documentos específicos en el sistema?</div>
            <div class="answer" id="answer8">Sí, el sistema cuenta con una función de búsqueda que te permite encontrar rápidamente documentos específicos utilizando palabras clave o criterios de búsqueda.</div>
        </div>
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(9)">¿El sistema tiene límites en cuanto al tamaño y cantidad de archivos que puedo almacenar?</div>
            <div class="answer" id="answer9">El tamaño y la cantidad de archivos que se pueden almacenar en el sistema pueden variar según la configuración y recursos disponibles. Es importante consultar las políticas de almacenamiento y límites establecidos en RedGestor para conocer las restricciones aplicables.</div>
        </div>
        <!-- Agrega más preguntas y respuestas aquí -->
    </div>

    </div>

<div class="sliderbar " id="slider">
  <div id="menu">
    <ul>
      <li class="menuz"><a href="paneldecontrol.php" class="menuv" style="text-decoration: none;">Panel de control</a></li>
      <li class="menuz"><a href="inventario.php" class="menuv" style="text-decoration: none;">Inventario</a></li>
      <li class="menuz"><a href="registro.php" class="menuv" style="text-decoration: none;">Registro</a></li>
      <li class="menuz"><a href="productos.php" class="menuv" style="text-decoration: none;">Cantidad de productos</a></li>
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