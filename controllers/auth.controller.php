<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../models/usuarios.model.php";

// Redirigir al login si no se reciben credenciales
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: ../login.php");
    exit();
}

try {
    $usuario = new Usuarios();
    $correo = $_POST['username'];
    $contrasena = hash('sha512', $_POST['password']);

    // Usa prepared statements para mayor seguridad
    $resultado = $usuario->authenticate($correo, $contrasena);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuarioautenticado = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
        $_SESSION['autenticado'] = $usuarioautenticado;
        header("Location: ../index.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>



