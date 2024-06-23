<?php
include '../models/conexion.model.php';

// Crear una instancia de la clase Conexion
try {
    $conexion = new Conexion();
    $conn = $conexion->getConnection();
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Insertar actividad en la base de datos
$curso_id = 1; // Cambia este valor al ID del curso que desees
$sql = "INSERT INTO actividades (curso_id, title, description) VALUES (?, 'Ejemplo de Actividad', 'Esta es una descripción de ejemplo para la actividad.')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $curso_id);
if ($stmt->execute()) {
    echo "Nueva actividad creada con éxito";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
