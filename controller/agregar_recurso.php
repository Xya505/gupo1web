<?php
include '../controller/conexion.php';


if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}


$type = $_POST['type'];
$title = $_POST['title'];
$description = $_POST['description'];


$sql = "INSERT INTO resources (type, title, description) VALUES ('$type', '$title', '$description')";

if (mysqli_query($conexion, $sql)) {
    echo "Nuevo recurso agregado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}


mysqli_close($conexion);


header("Location: ../models/agregar.php");
exit();
?>
