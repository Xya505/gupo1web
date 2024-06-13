<?php
include 'conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_title']) && isset($_POST['task_description'])) {
   
    $task_title = $_POST['task_title'];
    $task_description = $_POST['task_description'];

    
    $sql = "INSERT INTO tareas (titulo, descripcion) VALUES (?, ?)";
    
  
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error de preparación de la consulta: " . $conn->error);
    }

    
    $stmt->bind_param("ss", $task_title, $task_description);

  
    if ($stmt->execute()) {
        echo "Tarea agregada exitosamente";
    } else {
        echo "Error al agregar la tarea: " . $stmt->error;
    }

   
    $stmt->close();
}


$conn->close();
?>
