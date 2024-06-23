<?php
require_once "../res/zona_priv.php";
require_once "../res/header.php";
require_once "../res/menu.php";
require_once "../models/cursos.model.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    
    // Verificar si 'usuario_id' está definido en la sesión
    $profesor_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

    // Validar que 'profesor_id' no sea null
    if ($profesor_id === null) {
        echo "No se ha encontrado el ID del profesor en la sesión.";
        exit();
    }

    $curso = new Cursos();
    if ($curso->agregarCurso($nombre, $descripcion, $profesor_id)) {
        $_SESSION['mensaje'] = "Curso agregado correctamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el curso";
    }
    header("Location: cursos.php");
    exit();
}
?>

<div class="container mt-5">
    <h2>Agregar Curso</h2>
    <form action="agregar_curso.php" method="post">
        <div class="form-group">
            <label for="nombre">Nombre del Curso:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Curso</button>
    </form>
</div>

<?php require_once "../res/footer.php"; ?>

