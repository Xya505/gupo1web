<?php
require_once "../res/zona_priv.php";
require_once "../res/header.php";
require_once "../res/menu.php";
require_once "../models/tareas.model.php";

$objTareas = new Tareas();
$tareas = $objTareas->obtenerTareasPorCurso($curso_id); // Obtener las tareas del curso específico

?>

<div class="container mt-5">
    <h2 class="mb-4">Tabla de Tareas</h2>
    <?php if (isset($_GET['mensaje'])): ?>
        <div class="alert alert-info"><?= htmlspecialchars($_GET['mensaje']) ?></div>
    <?php endif; ?>
    <a href="agregar_tarea.php" class="btn btn-success mb-3">+ Agregar Tarea</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de Entrega</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tareas as $tarea): ?>
                <tr>
                    <td><?= htmlspecialchars($tarea['nombre']) ?></td>
                    <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                    <td><?= htmlspecialchars($tarea['fecha_entrega']) ?></td>
                    <td>
                        <a href="editar_tarea.php?id=<?= htmlspecialchars($tarea['id']) ?>" class="btn btn-primary btn-sm">Modificar</a>
                        <a href="eliminar_tarea.php?id=<?= htmlspecialchars($tarea['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "../res/footer.php"; ?>







               
