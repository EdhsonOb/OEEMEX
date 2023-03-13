// Función para cargar la lista de productos
function cargarProductos() {
    $.ajax({
      url: 'listar_productos.php',
      success: function(data) {
        $('#producto').html(data);
      }
    });
  }
  
  // Función para agregar un nuevo producto
  function agregarProducto() {
    // Obtener los datos del formulario
    const nombre = document.getElementById("nombre").value;
    const cantidad = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    const descripcion = document.getElementById("descripcion").value;
  
    // Validar que los campos no estén vacíos
    if (!nombre || !cantidad || !precio || !descripcion) {
      alert("Por favor complete todos los campos.");
      return;
    }
  
    // Enviar los datos al servidor utilizando AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "listar_productos.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        alert("Datos agregados correctamente");
        window.location.replace = "agregar.php";
      } else if (xhr.readyState === 4 && xhr.status !== 200) {
        alert("Error al agregar datos: " + xhr.statusText);
      }
    };
    xhr.send(
      "nombre=" + encodeURIComponent(nombre) +
      "&cantidad=" + encodeURIComponent(cantidad) +
      "&precio=" + encodeURIComponent(precio) +
      "&descripcion=" + encodeURIComponent(descripcion)
    );
  }
  
  // Función para editar un producto existente
  function editarProducto(id) {
    var nombre = $('#nombre_' + id).val();
    var descripcion = $('#descripcion_' + id).val();
    var cantidad = $('#cantidad_' + id).val();
    var precio = $('#precio_' + id).val();
  
    $.ajax({
      type: 'POST',
      url: 'Modificar.php',
      data: {
        id: id,
        nombre: nombre,
        descripcion: descripcion,
        cantidad: cantidad,
        precio: precio
      },
      success: function(data) {
        cargarProductos();
      }
    });
  }
  
  // Función para eliminar un producto
  function eliminarProducto(id) {
    if (confirm('¿Estás seguro de eliminar este producto?')) {
      $.ajax({
        type: 'POST',
        url: 'eliminar_producto.php',
        data: { id: id },
        success: function(data) {
          cargarProductos();
        }
      });
    }
  }
  
  $(document).ready(function() {
    cargarProductos();
  });