<?php
include "../res/zona_priv.php";  // Include de archivo de seguridad o autenticación
include_once "../res/header.php";
include_once "../res/menu.php";
include '../models/conexion.model.php';  // Include del archivo de conexión

// Crear una instancia de la clase Conexion
$conexion = new Conexion();

// Obtener la conexión
$conn = $conexion->getConnection();

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Procesar agregar usuario si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = hash('sha512', $_POST['password']);
    $rol = $_POST['rol']; // Seleccionar el rol desde el formulario

    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['tmp_name']) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    }

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_completo, correo, rol, contrasena, imagen) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssiss", $nombre, $correo, $rol, $contrasena, $imagen);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Mensaje de éxito o cualquier otro contenido HTML
        echo '<meta http-equiv="refresh" content="0;url=usuarios.view.php">';
        exit(); // Asegura que se detiene la ejecución del script después de la redirección
    } else {
        echo "Error al agregar el usuario: " . $stmt->error;
    }    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Agregar Usuario</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre Completo" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <label for="rol">Rol:</label>
                <select class="form-control" name="rol" id="rol" required>
                    <option value="1">Administrador</option>
                    <option value="2">Estudiante</option>
                    <option value="3">Profesor</option>
                </select>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen">
            </div>
            <button type="submit" class="btn btn-primary" name="agregar">Agregar</button>
        </form>
    </div>
</body>
</html>

<?php include_once "../res/footer.php"; ?>









