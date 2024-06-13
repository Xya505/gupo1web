<?php
session_start();
include 'conexion.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' and contrasena='$contrasena'");

if(mysqli_num_rows($validar_login) > 0) {
    $filas = mysqli_fetch_array($validar_login); 

    $_SESSION['usuario'] = $correo;

    if ($filas['rol'] == 1) { 
        header("location:../models/plataforma_admin/index.php");
    } elseif ($filas['rol'] == 2) {
        header("location:../models/plataforma_estudiante/index.php");
    } else {
        header("location: ../../views/index.php"); 
        exit; 
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
?>


