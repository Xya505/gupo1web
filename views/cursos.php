<?php
include "../res/zona_priv.php";
include_once "../res/header.php";
include_once "../res/menu.php";
include '../models/conexion.model.php';

// Crear una instancia de la clase Conexion
try {
    $conexion = new Conexion();
    $conn = $conexion->getConnection();
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Procesar el formulario para agregar o editar un curso
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $rol == 1) {
    if ($_POST['action'] == 'add') {
        // Validar y obtener los datos del formulario
        $year = $_POST['year'];
        $name = $_POST['name'];

        // Preparar la consulta SQL para insertar el nuevo curso
        $sql_insert = "INSERT INTO cursos (year, name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("ss", $year, $name);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">Curso agregado correctamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al agregar el curso: ' . $conn->error . '</div>';
        }

        // Cerrar la declaración
        $stmt->close();
    } elseif ($_POST['action'] == 'edit') {
        // Validar y obtener los datos del formulario
        $id = $_POST['id'];
        $year = $_POST['year'];
        $name = $_POST['name'];

        // Preparar la consulta SQL para actualizar el curso
        $sql_update = "UPDATE cursos SET year = ?, name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ssi", $year, $name, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">Curso actualizado correctamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al actualizar el curso: ' . $conn->error . '</div>';
        }

        // Cerrar la declaración
        $stmt->close();
    }
}

// Procesar la solicitud para eliminar un curso
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id']) && $rol == 1) {
    $delete_id = $_GET['delete_id'];

    // Preparar la consulta SQL para eliminar el curso
    $sql_delete = "DELETE FROM cursos WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $delete_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">Curso eliminado correctamente.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error al eliminar el curso: ' . $conn->error . '</div>';
    }

    // Cerrar la declaración
    $stmt->close();
}

// Realizar la consulta a la base de datos para mostrar los cursos
$sql = "SELECT * FROM cursos ORDER BY name";
$result = $conn->query($sql);
?>

<div class="container">
    <h1 class="my-2">Mis Cursos</h1>
    
    <!-- Botón para abrir el formulario modal para agregar, solo visible para rol 1 -->
    <?php if ($rol == 1) { ?>
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCourseModal">
            Agregar Curso
        </button>
    </div>
    <?php } ?>

    <!-- Formulario modal para agregar un nuevo curso, solo visible para rol 1 -->
    <?php if ($rol == 1) { ?>
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Agregar Nuevo Curso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        <div class="form-group">
                            <label for="year">Año:</label>
                            <input type="text" class="form-control" id="year" name="year" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Mostrar lista de cursos existentes -->
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row["name"]) . '</h5>';
                echo '<p class="card-text"><span class="badge badge-primary">' . htmlspecialchars($row["year"]) . '</span></p>';
                echo '<a href="actividades.php?curso_id=' . $row["id"] . '" class="btn btn-primary">Ver Actividades</a>';
                if ($rol == 1) {
                    echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editCourseModal' . $row["id"] . '">Editar</button> ';
                    echo '<a href="cursos.php?delete_id=' . $row["id"] . '" class="btn btn-danger" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este curso?\')">Eliminar</a>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Formulario modal para editar curso, solo visible para rol 1
                if ($rol == 1) {
                    echo '<div class="modal fade" id="editCourseModal' . $row["id"] . '" tabindex="-1" aria-labelledby="editCourseModalLabel' . $row["id"] . '" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="editCourseModalLabel' . $row["id"] . '">Editar Curso</h5>';
                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                    echo '<form method="post">';
                    echo '<div class="modal-body">';
                    echo '<input type="hidden" name="action" value="edit">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<div class="form-group">';
                    echo '<label for="year">Año:</label>';
                    echo '<input type="text" class="form-control" id="year" name="year" value="' . htmlspecialchars($row["year"]) . '" required>';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="name">Nombre:</label>';
                    echo '<input type="text" class="form-control" id="name" name="name" value="' . htmlspecialchars($row["name"]) . '" required>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                    echo '<button type="submit" class="btn btn-primary">Guardar Cambios</button>';
                    echo '</div>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            echo '<div class="col-md-12">';
            echo '<p>No hay cursos disponibles.</p>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include_once "../res/footer.php"; ?>

