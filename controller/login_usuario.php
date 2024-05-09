<?php
session_start();
include 'conexion.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' and contrasena='$contrasena'");

if(mysqli_num_rows($validar_login) > 0) {
    $filas = mysqli_fetch_array($validar_login); // Obtener la fila de la consulta

    $_SESSION['usuario'] = $correo;

    if ($filas['rol'] == 1) { // Admin
        header("location:../views/docente.php");
    } elseif ($filas['rol'] == 2) { // Estudiante
        header("location:../views/plataforma.php");
    } else {
        header("location:../views/index.php");
        exit; // Salir del script después de redireccionar
    }
} else {
    echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: "error",
                title: "Usuario no existe",
                text: "Por favor verifique los datos introducidos",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../views/index.php";
                }
            });
        </script>
    ';
    exit;
}

