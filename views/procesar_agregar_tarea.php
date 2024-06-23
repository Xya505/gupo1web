<?php
require_once "../res/zona_priv.php";
require_once "../models/tareas.model.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $archivo = $_FILES['archivo'];

    if ($archivo['error'] == UPLOAD_ERR_OK) {
        $ruta_destino = '../uploads/' . basename($archivo['name']);
        move_uploaded_file($archivo['tmp_name'], $ruta_destino);
    } else {
        $ruta_destino = null;
    }

    $objTareas = new Tareas();
    if ($objTareas->agregarTarea($nombre, $descripcion, $fecha_entrega, $ruta_destino, $estudiante_id)) {
        header('Location: tareas.view.php?mensaje=Tarea agregada correctamente');
    } else {
        header('Location: tareas.view.php?mensaje=Error al agregar la tarea');
    }
    exit();
}
?>

