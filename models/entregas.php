<?php
include '../controller/conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grupo = $_POST['grupo'];
    $estado_entrega = $_POST['estado_entrega'];
    $estado_calificacion = $_POST['estado_calificacion'];
    $tiempo_restante = $_POST['tiempo_restante'];
    $ultima_modificacion = $_POST['ultima_modificacion'];
    $archivo_enviado = $_POST['archivo_enviado'];
    $comentarios = $_POST['comentarios'];

    $sql = "INSERT INTO entregas (grupo, estado_entrega, estado_calificacion, tiempo_restante, ultima_modificacion, archivo_enviado, comentarios) 
            VALUES ('$grupo', '$estado_entrega', '$estado_calificacion', '$tiempo_restante', '$ultima_modificacion', '$archivo_enviado', '$comentarios')";

    if ($conexion->query($sql) === TRUE) {
        
        header('Location: ../controller/mostrar_tareas.php');
        print_r(headers_list());
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

if (isset($conexion)) {
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Entrega</title>
    <link rel="stylesheet" href="../css/entrga.css">
</head>
<body>
    <div class="container">
        <h1 class="form-header">Registrar Entrega de Tarea</h1>
        <form action="entrega.php" method="post">
            <div class="form-group">
                <label for="grupo">Grupo:</label>
                <input type="text" id="grupo" name="grupo">
            </div>

            <div class="form-group">
                <label for="estado_entrega">Estado de la entrega:</label>
                <input type="text" id="estado_entrega" name="estado_entrega">
            </div>

            <div class="form-group">
                <label for="estado_calificacion">Estado de la calificación:</label>
                <input type="text" id="estado_calificacion" name="estado_calificacion">
            </div>

            <div class="form-group">
                <label for="tiempo_restante">Tiempo restante:</label>
                <input type="text" id="tiempo_restante" name="tiempo_restante">
            </div>

            <div class="form-group">
                <label for="ultima_modificacion">Última modificación:</label>
                <input type="datetime-local" id="ultima_modificacion" name="ultima_modificacion">
            </div>

            <div class="form-group">
                <label for="archivo_enviado">Archivo enviado:</label>
                <input type="text" id="archivo_enviado" name="archivo_enviado">
            </div>

            <div class="form-group">
                <label for="comentarios">Comentarios:</label>
                <textarea id="comentarios" name="comentarios"></textarea>
            </div>

            <input type="submit" value="Registrar Entrega" class="btn-submit">
        </form>
    </div>
</body>
</html>





