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
  

// Obtén la referencia a la tabla y al canvas
const table = document.getElementById("myTable");
//seleccionamos la referencia canvas y trabajamos con el formato 2d de la biblioteca Chart.js
const ctx = document.getElementById("myChart").getContext("2d");

// Extrae los datos de la tabla
const labels = [];
const data = [];

const rows = table.getElementsByTagName("tr");
for (let i = 1; i < rows.length; i++) {
  const cells = rows[i].getElementsByTagName("td");
  labels.push(cells[0].textContent);
  data.push(parseInt(cells[1].textContent));
}

// Crea el gráfico con Chart.js
const chart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Ventas",
        data: data,
        backgroundColor: "rgba(75, 192, 192, 0.2)",
        borderColor: "rgba(75, 192, 192, 1)",
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

// Este código tiene dos partes principales: extracción de datos de la tabla HTML y creación de un gráfico con Chart.js.

// 1. Extracción de datos de la tabla HTML:

// ```javascript
// const labels = [];
// const data = [];
// const rows = table.getElementsByTagName("tr");
// for (let i = 1; i < rows.length; i++) {
//   const cells = rows[i].getElementsByTagName("td");
//   labels.push(cells[0].textContent);
//   data.push(parseInt(cells[1].textContent));
// }
// ```

// - `labels` y `data` son arrays vacíos que almacenarán las etiquetas (meses) y los datos (ventas) extraídos de la tabla.
// - `table.getElementsByTagName("tr")` obtiene todas las filas (`<tr>`) de la tabla.
// - El bucle `for` comienza en `i = 1` para saltarse la fila del encabezado y recorre todas las filas de la tabla.
// - `rows[i].getElementsByTagName("td")` obtiene todas las celdas (`<td>`) de la fila actual.
// - `cells[0].textContent` y `cells[1].textContent` obtienen el contenido de texto de la primera y segunda celda de la fila, respectivamente.
// - `labels.push(cells[0].textContent)` guarda el mes en el array `labels`.
// - `data.push(parseInt(cells[1].textContent))` convierte el valor de ventas a un número entero y lo guarda en el array `data`.

// 2. Creación del gráfico con Chart.js:

// ```javascript
// const chart = new Chart(ctx, {
//   type: "bar",
//   data: {
//     labels: labels,
//     datasets: [
//       {
//         label: "Ventas",
//         data: data,
//         backgroundColor: "rgba(75, 192, 192, 0.2)",
//         borderColor: "rgba(75, 192, 192, 1)",
//         borderWidth: 1,
//       },
//     ],
//   },
//   options: {
//     scales: {
//       y: {
//         beginAtZero: true,
//       },
//     },
//   },
// });
// ```

// - `new Chart(ctx, {...})` crea un nuevo gráfico utilizando el contexto 2D del canvas (`ctx`) y la configuración proporcionada.
// - `type: "bar"` indica que se creará un gráfico de barras.
// - `labels: labels` y `data: data` establecen las etiquetas y datos del gráfico a partir de los arrays extraídos de la tabla.
// - `backgroundColor`, `borderColor` y `borderWidth` definen el color y el ancho del borde de las barras en el gráfico.
// - `options` contiene opciones adicionales para el gráfico, como `beginAtZero: true`, que indica que el eje Y debe comenzar en cero.