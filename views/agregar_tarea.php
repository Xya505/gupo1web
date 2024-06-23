<?php
require_once "../res/zona_priv.php";
require_once "../res/header.php";
require_once "../res/menu.php";
require_once "../models/tareas.model.php";

session_start();

// Verificar que curso_id se pasa correctamente en la URL
$curso_id = filter_input(INPUT_GET, 'curso_id', FILTER_VALIDATE_INT);
if ($curso_id === false || $curso_id === null) {
    echo "Curso ID no válido en la URL.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fecha_entrega = filter_input(INPUT_POST, 'fecha_entrega', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $archivo = $_FILES['archivo'];

    echo "Curso ID: $curso_id_post<br>";
    echo "Nombre: $nombre<br>";
    echo "Descripción: $descripcion<br>";
    echo "Fecha de Entrega: $fecha_entrega<br>";
    echo "Archivo: " . print_r($archivo, true) . "<br>";

    // Resto del código
    $ruta_destino = null;
    if ($archivo['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'application/pdf', 'application/sql'];
        $max_size = 2 * 1024 * 1024; // Máximo 2MB
        if (in_array($archivo['type'], $allowed_types) && $archivo['size'] <= $max_size) {
            $uploads_dir = '../uploads';
            if (!is_dir($uploads_dir) && !mkdir($uploads_dir, 0777, true) && !is_dir($uploads_dir)) {
                throw new \RuntimeException(sprintf('El directorio "%s" no fue creado', $uploads_dir));
            }
            $nombre_archivo = uniqid() . '-' . basename($archivo['name']);
            $ruta_destino = $uploads_dir . '/' . $nombre_archivo;
            if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
                // Archivo cargado correctamente
            } else {
                // Error al mover el archivo
                $ruta_destino = null;
            }
        } else {
            // Tipo o tamaño de archivo no permitido
            $ruta_destino = null;
        }
    }

    $objTareas = new Tareas();
    if ($objTareas->agregarTarea($curso_id_post, $nombre, $descripcion, $fecha_entrega, $ruta_destino)) {
        $_SESSION['mensaje'] = "Tarea agregada correctamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar la tarea";
    }
    header("Location: ver_curso.php?id=" . $curso_id_post);
    exit();
}
?>

<div class="container mt-5">
    <h2>Agregar Tarea</h2>
    <form action="agregar_tarea.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="curso_id" value="<?php echo htmlspecialchars($curso_id); ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="form-group">
            <label for="fecha_entrega">Fecha de Entrega:</label>
            <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
        </div>
        <div class="form-group">
            <label for="archivo">Subir Archivo:</label>
            <input type="file" class="form-control" id="archivo" name="archivo">
        </div>
        <button type="submit" class="btn btn-primary">Agregar Tarea</button>
    </form>
</div>

<?php require_once "../res/footer.php"; ?>











