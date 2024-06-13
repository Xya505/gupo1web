<?php
include '../controller/conexion.php';

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id = $_POST['id'];
$type = $_POST['type'];
$title = $_POST['title'];
$description = $_POST['description'];


$sql = "UPDATE activities SET type='$type', title='$title', description='$description' WHERE id='$id'";

if (mysqli_query($conexion, $sql)) {
    echo "Actividad actualizada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}


mysqli_close($conexion);


header("Location: ../models/agregar.php");
exit();
?>
