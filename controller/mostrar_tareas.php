<?php
include '../controller/conexion.php'; 


if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}


$sql = "SELECT * FROM entregas";
$resultado = $conexion->query($sql);

if ($resultado && $resultado->num_rows > 0) {

    echo "<h1>Tareas Guardadas</h1>";
    echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Grupo</th>
            <th>Estado Entrega</th>
            <th>Estado Calificación</th>
            <th>Tiempo Restante</th>
            <th>Última Modificación</th>
            <th>Archivo Enviado</th>
            <th>Comentarios</th>
        </tr>";

    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['grupo'] . "</td>";
        echo "<td>" . $row['estado_entrega'] . "</td>";
        echo "<td>" . $row['estado_calificacion'] . "</td>";
        echo "<td>" . $row['tiempo_restante'] . "</td>";
        echo "<td>" . $row['ultima_modificacion'] . "</td>";
        echo "<td>" . $row['archivo_enviado'] . "</td>";
        echo "<td>" . $row['comentarios'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron tareas guardadas.";
}

$conexion->close();
?>





