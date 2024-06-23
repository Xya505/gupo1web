<?php
// Iniciar sesión
session_start();

// Incluir archivos necesarios y configurar la conexión
require_once "../res/zona_priv.php";
require_once "../res/header.php";
require_once "../res/menu.php";
require_once '../models/conexion.model.php';

// Verificar sesión de usuario autenticado
if (!isset($_SESSION['autenticado'])) {
    die("Acceso denegado. Por favor, inicie sesión.");
}

// Verificar rol de usuario
$rol = $_SESSION['autenticado']['rol'];
if ($rol != 2) {
    die("Acceso denegado. Esta página solo está disponible para usuarios con rol 2.");
}

// Crear una instancia de la clase Conexion
try {
    $conexion = new Conexion();
    $conn = $conexion->getConnection();
} catch (Exception $e) {
    die("Fallo de conexión: " . $e->getMessage());
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

        // Obtener el ID de la actividad desde la URL
        if (isset($_GET['actividad_id'])) {
            $actividad_id = $_GET['actividad_id'];

            // Realizar la consulta para obtener los detalles de la actividad
            $sql_actividad = "SELECT * FROM actividades WHERE id = ?";
            $stmt_actividad = $conn->prepare($sql_actividad);
            $stmt_actividad->bind_param('i', $actividad_id);
            $stmt_actividad->execute();
            $result_actividad = $stmt_actividad->get_result();

            if ($result_actividad->num_rows > 0) {
                $actividad = $result_actividad->fetch_assoc();
            } else {
                die("Error: No se encontró la actividad con ID proporcionado.");
            }

            // Cerrar declaración preparada
            $stmt_actividad->close();
        } else {
            die("Error: No se ha proporcionado actividad_id.");
        } 

        // Procesar la respuesta del estudiante si se envía el formulario POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validar y limpiar datos del formulario
            if (isset($_POST['respuesta'])) {
                $respuesta = htmlspecialchars($_POST['respuesta']);

                // Insertar la respuesta en la base de datos
                $sql_insert = "INSERT INTO respuestas (actividad_id, estudiante_id, respuesta) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql_insert);
                $stmt->bind_param('iis', $actividad_id, $estudiante_id, $respuesta);

                // Verificar si se ejecuta la consulta correctamente
                if ($stmt->execute()) {
                    // Redirigir a esta misma página con el actividad_id para evitar reenvío del formulario
                    echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: "success",
                                title: "¡Éxito!",
                                text: "Usted ha enviado la tarea.",
                            }).then((result) => {
                                window.location.href = "responder_actividad.php?actividad_id=' . $actividad_id . '";
                            });
                        });
                    </script>';
                } else {
                    echo '<div class="alert alert-danger">Error al enviar la respuesta.</div>';
                }

                // Cerrar declaración preparada
                $stmt->close();
            } else {
                die("Error: No se ha proporcionado respuesta.");
            }
        }
    } else {
        die("Error: No se encontró el estudiante.");
    }

    // Cerrar declaración preparada
    $stmt_estudiante->close();
} else {
    die("Error: No se ha proporcionado nombre de usuario en la sesión.");
}

// Cerrar la conexión
$conn->close();
?>

<div class="container">
    <h2 class="my-4">Responder Actividad</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($actividad['title']); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($actividad['description']); ?></p>
            <form method="POST">
                <div class="form-group">
                    <label for="respuesta">Tu Respuesta</label>
                    <textarea class="form-control" id="respuesta" name="respuesta" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Respuesta</button>
            </form>
        </div>
    </div>
</div>

<?php include_once "../res/footer.php"; ?>



