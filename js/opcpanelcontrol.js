function cargarContenido(url) {
    var xhttp = new XMLHttpRequest(); // Crea un objeto XMLHttpRequest para realizar una solicitud HTTP asíncrona

    xhttp.onreadystatechange = function() { // Define una función que se ejecutará cada vez que cambie el estado de la solicitud
        if (this.readyState == 4 && this.status == 200) { // Verifica si la solicitud se ha completado y si el estado de la respuesta es 200 (éxito)
            document.getElementById("contenido").innerHTML = this.responseText; // Actualiza el contenido del elemento con el ID "contenido" con la respuesta del servidor
        }
    };  
    xhttp.open("GET", url, true); // Configura la solicitud HTTP GET para obtener la URL especificada de forma asíncrona
    xhttp.send(); // Envía la solicitud HTTP al servidor
  }