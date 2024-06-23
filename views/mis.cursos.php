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

// Realizar la consulta a la base de datos
$sql = "SELECT * FROM cursos";
$result = $conn->query($sql);
?>

<div class="container">
    <h2 class="my-4">Mis Cursos</h2>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                echo '<p class="card-text"><span class="badge badge-primary">' . $row["year"] . '</span></p>';
                echo '<a href="actividades.php?curso_id=' . $row["id"] . '" class="btn btn-primary">Ver Actividades</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay cursos disponibles.</p>';
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include_once "../res/footer.php"; ?>
