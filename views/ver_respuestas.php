<?php
// Incluir archivos necesarios y configurar la conexión
require_once "../res/zona_priv.php";
require_once "../res/header.php";
require_once "../res/menu.php";
require_once '../models/conexion.model.php';

// Verificar rol de usuario
session_start();
if (!isset($_SESSION['autenticado'])) {
    die("Acceso denegado. Por favor, inicie sesión.");
}

$rol = $_SESSION['autenticado']['rol'];
if ($rol != 3) {
    die("Acceso denegado. Esta página solo está disponible para usuarios con rol 3.");
}

// Crear una instancia de la clase Conexion
try {
    $conexion = new Conexion();
    $conn = $conexion->getConnection();
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Obtener el nombre de usuario desde la sesión
if (isset($_SESSION['autenticado']['nombre_completo'])) {
    $nombre_completo = $_SESSION['autenticado']['nombre_completo'];

    // Obtener el ID del estudiante usando el nombre de usuario
    $sql_estudiante = "SELECT id FROM usuarios WHERE nombre_completo = ?";
    $stmt_estudiante = $conn->prepare($sql_estudiante);
    $stmt_estudiante->bind_param('s', $nombre_completo);
    $stmt_estudiante->execute();
    $result_estudiante = $stmt_estudiante->get_result();

    // Verificar si se encontró el estudiante
    if ($result_estudiante->num_rows > 0) {
        $row_estudiante = $result_estudiante->fetch_assoc();
        $estudiante_id = $row_estudiante['id'];

        // Obtener el ID de la actividad para la cual se desean ver las respuestas
        if (isset($_GET['actividad_id'])) {
            $actividad_id = $_GET['actividad_id'];

            // Consulta para obtener las respuestas de la actividad
            $sql = "SELECT r.*, a.title AS titulo_actividad, a.description AS descripcion_actividad, u.nombre_completo 
                    FROM respuestas r
                    INNER JOIN usuarios u ON r.estudiante_id = u.id
                    INNER JOIN actividades a ON r.actividad_id = a.id
                    WHERE r.actividad_id = ? AND u.nombre_completo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('is', $actividad_id, $nombre_completo);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si hay respuestas
            if ($result->num_rows > 0) {
                $respuestas = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $respuestas = [];
            }

            // Cerrar declaración preparada
            $stmt->close();
        } else {
            die("Error: No se ha proporcionado actividad_id.");
        }
    } else {
        die("Error: No se encontró el estudiante.");
    }

    // Cerrar declaración preparada
    $stmt_estudiante->close();
} else {
    die("Error: No se ha proporcionado nombre de usuario en la sesión.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuestas de Actividad</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Respuestas de la Actividad</h2>
        <div class="card">
            <div class="card-body">
                <?php if (!empty($respuestas)): ?>
                    <h5 class="card-title"><?php echo htmlspecialchars($respuestas[0]['titulo_actividad']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($respuestas[0]['descripcion_actividad']); ?></p>
                    <div class="list-group">
                        <?php foreach ($respuestas as $respuesta): ?>
                            <div class="list-group-item">
                                <h6 class="mb-1"><?php echo htmlspecialchars($respuesta['nombre_completo']); ?></h6>
                                <p class="mb-1"><?php echo htmlspecialchars($respuesta['respuesta']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No hay respuestas para mostrar.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js" integrity="sha384-PN3fTGkVXNCFklt3umRTBkqKFOgSkKxyxWgZKwHVflZ6K/FAU8hMkYSJi2ZBLJ7O" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+J0k/dXGygq4JZgqixGzfusv/rkvxyapaXp" crossorigin="anonymous"></script>
</body>
</html>

<?php include_once "../res/footer.php"; ?>




