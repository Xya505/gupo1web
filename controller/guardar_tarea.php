<?php
include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grupo = $_POST['grupo'];
    $estado_entrega = $_POST['estado_entrega'];
    $estado_calificacion = $_POST['estado_calificacion'];
    $tiempo_restante = $_POST['tiempo_restante'];
    $archivo_enviado = $_POST['archivo_enviado'];
    $comentarios = $_POST['comentarios'];

    $sql = "INSERT INTO tareas (grupo, estado_entrega, estado_calificacion, tiempo_restante, archivo_enviado, comentarios) 
            VALUES ('$grupo', '$estado_entrega', '$estado_calificacion', '$tiempo_restante', '$archivo_enviado', '$comentarios')";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva tarea registrada con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($conn)) {
    $conn->close();
}
?>
