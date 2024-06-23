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

// Procesar la búsqueda si se ha enviado
if(isset($_GET['buscar']) && !empty($_GET['buscar'])) {
    $buscar = $conn->real_escape_string($_GET['buscar']);
    $sql = "SELECT * FROM actividades WHERE title LIKE '%$buscar%'";
} else {
    $sql = "SELECT * FROM actividades";
}

$result = $conn->query($sql);
?>

<div class="container">
    <h2 class="my-4">Actividades de Todos los Cursos</h2>

    <!-- Formulario de búsqueda -->
    <form action="" method="GET" class="mb-4">
        <div class="form-group">
            <label for="buscar">Buscar actividad por título:</label>
            <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Ingrese título de la actividad">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row["title"]) . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($row["description"]) . '</p>';
                echo '<a href="responder_actividad.php?actividad_id=' . $row["id"] . '" class="btn btn-primary">Responder</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay actividades disponibles.</p>';
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include_once "../res/footer.php"; ?>


