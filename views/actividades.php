<?php
// Incluir archivos necesarios
include "../res/zona_priv.php";
include_once "../res/header.php";
include_once "../res/menu.php";
include '../models/conexion.model.php';

// Verificar si el usuario está autenticado y tiene un rol adecuado
session_start();
if (!isset($_SESSION['autenticado'])) {
    die("Acceso denegado. Por favor, inicie sesión.");
}

$rol = $_SESSION['autenticado']['rol'];

// Función para limpiar datos
function limpiar($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}

// Crear una instancia de la clase Conexion
try {
    $conexion = new Conexion();
    $conn = $conexion->getConnection();
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Manejo de inserción de nueva actividad
$insertMessage = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_activity']) && $rol == 3) {
    // Validar y limpiar datos del formulario
    $curso_id = $_POST['curso_id'];
    $title = limpiar($_POST['title']);
    $description = limpiar($_POST['description']);

    // Preparar consulta SQL para insertar nueva actividad
    $sql_insert = "INSERT INTO actividades (curso_id, title, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("iss", $curso_id, $title, $description);

    // Ejecutar consulta y verificar
    if ($stmt->execute()) {
        $insertMessage = '<div class="alert alert-success" role="alert">Actividad agregada correctamente.</div>';
    } else {
        $insertMessage = '<div class="alert alert-danger" role="alert">Error al agregar la actividad.</div>';
    }

    // Cerrar declaración preparada
    $stmt->close();
}

// Función para eliminar una actividad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_activity']) && $rol == 3) {
    $activity_id = $_POST['activity_id'];

    // Preparar consulta SQL para eliminar la actividad
    $sql_delete = "DELETE FROM actividades WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $activity_id);

    // Ejecutar consulta y verificar
    if ($stmt->execute()) {
        $deleteMessage = '<div class="alert alert-success" role="alert">Actividad eliminada correctamente.</div>';
    } else {
        $deleteMessage = '<div class="alert alert-danger" role="alert">Error al eliminar la actividad.</div>';
    }

    // Cerrar declaración preparada
    $stmt->close();
}

// Obtener curso_id de la URL
if (isset($_GET['curso_id'])) {
    $curso_id = $_GET['curso_id'];

    // Consulta SQL para obtener todas las actividades de este curso
    $sql = "SELECT * FROM actividades WHERE curso_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $curso_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si hay actividades para ese curso
    if ($result->num_rows > 0) {
        $activities = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $activities = [];
    }

    // Cerrar declaración preparada
    $stmt->close();
} else {
    die("Error: No se ha proporcionado curso_id.");
}

// Mostrar la estructura HTML junto con las actividades y formulario para agregar
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades del Curso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .activity-header {
            background-color: #ffc107;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
        .activity-item {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .add-activity-form {
            display: none; /* Formulario inicialmente oculto */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            width: 80%;
            max-width: 600px;
        }
        .overlay {
            display: none; /* Fondo oscuro inicialmente oculto */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Actividades del Curso</h1>

        <div class="list-group">
            <?php foreach ($activities as $activity): ?>
                <div class="activity-item">
                    <h5 class="mb-1"><?= htmlspecialchars($activity["description"]) ?></h5>
                    <p class="mb-1"><?= htmlspecialchars($activity["title"]) ?></p>
                    <?php if ($rol == 3): ?>
                        <form method="post" class="mb-1">
                            <input type="hidden" name="activity_id" value="<?= $activity["id"] ?>">
                            <button type="submit" name="delete_activity" class="btn btn-danger btn-sm mr-2">Eliminar</button>
                            <a href="ver_respuestas.php?actividad_id=<?= $activity["id"] ?>" class="btn btn-info btn-sm">Ver Respuestas</a>
                            <a href="editar_actividad.php?id=<?= $activity["id"] ?>" class="btn btn-primary btn-sm">Editar</a>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($rol == 3): ?>
            <!-- Botón para mostrar el formulario de agregar nueva actividad -->
            <button id="showFormBtn" class="btn btn-primary mt-3">Agregar Nueva Actividad</button>

            <!-- Overlay oscuro y formulario para agregar nueva actividad -->
            <div id="overlay" class="overlay"></div>
            <div id="addActivityForm" class="add-activity-form">
                <h4>Agregar Nueva Actividad</h4>
                <?= $insertMessage ?>
                <form method="post">
                    <input type="hidden" name="curso_id" value="<?= htmlspecialchars($curso_id) ?>">
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="add_activity" class="btn btn-primary">Agregar Actividad</button>
                    <button type="button" class="btn btn-secondary ml-2" onclick="closeForm()">Cancelar</button>
                </form>
            </div>
        <?php endif; ?>

        <!-- Botón para volver a la página de cursos -->
        <a href="cursos.php" class="btn btn-secondary mt-3">Volver a Cursos</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript para mostrar y ocultar el formulario de agregar actividad
        $(document).ready(function() {
            $('#showFormBtn').click(function() {
                $('#overlay').fadeIn();
                $('#addActivityForm').fadeIn();
            });

            // Función para cerrar el formulario y el overlay
            function closeForm() {
                $('#overlay').fadeOut();
                $('#addActivityForm').fadeOut();
            }

            // Cerrar formulario y overlay al hacer clic fuera del formulario
            $('#overlay').click(function() {
                closeForm();
            });
        });
    </script>
</body>
</html>

<?php include_once "../res/footer.php"; ?>






