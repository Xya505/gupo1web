<?php
require_once "../res/zona_priv.php";
require_once "../res/header.php";
require_once "../res/menu.php";
require_once "../models/cursos.model.php";
require_once "../models/tareas.model.php";

$curso_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$curso_modelo = new Cursos();
$curso = $curso_modelo->obtenerCursoPorId($curso_id); // Asegúrate de que esta función esté implementada en cursos.model.php

$tareas_modelo = new Tareas();
$lista_tareas = $tareas_modelo->obtenerTareasPorCurso($curso_id);
?>

<div class="container mt-5">
    <h2><?php echo $curso['nombre']; ?></h2>
    <p><?php echo $curso['descripcion']; ?></p>
    <a href="agregar_tarea.php?curso_id=<?php echo $curso_id; ?>" class="btn btn-primary mb-3">Agregar Tarea</a>
    <div class="row">
        <?php foreach ($lista_tareas as $tarea): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $tarea['nombre']; ?></h5>
                        <p class="card-text"><?php echo $tarea['descripcion']; ?></p>
                        <p class="card-text"><small class="text-muted">Fecha de entrega: <?php echo $tarea['fecha_entrega']; ?></small></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once "../res/footer.php"; ?>
