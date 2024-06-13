
<?php
$conexion = mysqli_connect("localhost", "root", "", "login");

if ($conexion) {
    echo "Conectado exitosamente a la Base de datos<br>";
} else {
    die("NO se ha podido conectar: " . mysqli_connect_error());
}
$sql = "SELECT nombre_completo, correo, contrasena, rol FROM usuarios";
$result = mysqli_query($conexion, $sql);

?>


