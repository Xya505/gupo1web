function agregarTarea() {
    const nuevaFecha = document.getElementById("nuevaFecha").value;
    const nuevaDescripcion = document.getElementById("nuevaDescripcion").value;
    const nuevoPuntaje = document.getElementById("nuevoPuntaje").value;
    const nuevoEstado = document.getElementById("nuevoEstado").value;
    const nuevaObservacion = document.getElementById("nuevaObservacion").value;

    // Crear una nueva fila y agregarla a la tabla
    const tabla = document.querySelector("table");
    const nuevaFila = tabla.insertRow(-1); // -1 para agregar al final
    const celdaFecha = nuevaFila.insertCell(0);
    const celdaDescripcion = nuevaFila.insertCell(1);
    const celdaPuntaje = nuevaFila.insertCell(2);
    const celdaEstado = nuevaFila.insertCell(3);
    const celdaObservacion = nuevaFila.insertCell(4);
    const celdaEliminar = nuevaFila.insertCell(5);

    // Asignar valores a las celdas de la nueva fila
    celdaFecha.textContent = nuevaFecha;
    celdaDescripcion.textContent = nuevaDescripcion;
    celdaPuntaje.textContent = nuevoPuntaje;
    celdaEstado.textContent = nuevoEstado;
    celdaObservacion.textContent = nuevaObservacion;
    celdaEliminar.innerHTML = '<button onclick="eliminarTarea(this)">Eliminar</button>';
}

function eliminarTarea(button) {
    // Obtener la fila que contiene el botón
    const fila = button.parentNode.parentNode;

    // Eliminar la fila
    fila.parentNode.removeChild(fila);
}
