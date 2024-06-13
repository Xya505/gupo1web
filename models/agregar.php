<?php
include '../controller/conexion.php'; 

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sql_resources = "SELECT id, type, title, description FROM resources";
$result_resources = mysqli_query($conexion, $sql_resources);
if (!$result_resources) {
    die("Error en la consulta de recursos: " . mysqli_error($conexion));
}

$sql_activities = "SELECT id, type, title, description FROM activities";
$result_activities = mysqli_query($conexion, $sql_activities);
if (!$result_activities) {
    die("Error en la consulta de actividades: " . mysqli_error($conexion));
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recursos y Actividades de Aprendizaje</title>
    <link rel="stylesheet" href="../css/agregar.css">
    <style>
        .section {
            margin-bottom: 20px;
        }

        .active-section {
            display: block;
        }

        .inactive-section {
            display: none;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="section">
    <h2>Recursos de Aprendizaje</h2>
    <button onclick="toggleSection('resources')">Ver Recursos</button>
    <div id="resources" class="active-section">
        <table id="resources_table">
            <tr>
                <th>Tipo</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php
            if (mysqli_num_rows($result_resources) > 0) {
                while($row = mysqli_fetch_assoc($result_resources)) {
                    echo "<tr data-id='" . $row["id"] . "'>
                            <td>" . $row["type"] . "</td>
                            <td>" . $row["title"] . "</td>
                            <td>" . $row["description"] . "</td>
                            <td>
                                <button onclick='editResource(" . $row["id"] . ")'>Editar</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron resultados de recursos</td></tr>";
            }
            ?>
        </table>
        <button onclick="showForm('add_resource_form')">Agregar Recurso</button>

        <div id="edit_resource_form" class="modal">
            <div class="modal-content">
                <span class="close" onclick="hideForm('edit_resource_form')">&times;</span>
                <h3>Editar Recurso</h3>
                <form method="post" action="../controller/editar_recurso.php">
                    <input type="hidden" id="edit_resource_id" name="id">
                    Tipo: <input type="text" id="edit_resource_type" name="type"><br>
                    Título: <input type="text" id="edit_resource_title" name="title"><br>
                    Descripción: <input type="text" id="edit_resource_description" name="description"><br>
                    <input type="submit" value="Guardar">
                </form>
            </div>
        </div>

        <div id="add_resource_form" style="display: none;">
            <h3>Agregar Recurso</h3>
            <form method="post" action="../controller/agregar_recurso.php">
                Tipo: <input type="text" id="add_resource_type" name="type"><br>
                Título: <input type="text" id="add_resource_title" name="title"><br>
                Descripción: <input type="text" id="add_resource_description" name="description"><br>
                <input type="submit" value="Guardar">
            </form>
        </div>
    </div>
</div>

<div class="section">
    <h2>Actividades de Aprendizaje</h2>
    <button onclick="toggleSection('activities')">Ver Actividades</button>
    <div id="activities" class="inactive-section">
        <table id="activities_table">
            <tr>
                <th>Tipo</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php
            if (mysqli_num_rows($result_activities) > 0) {
                while($row = mysqli_fetch_assoc($result_activities)) {
                    echo "<tr data-id='" . $row["id"] . "'>
                            <td>" . $row["type"] . "</td>
                            <td>" . $row["title"] . "</td>
                            <td>" . $row["description"] . "</td>
                            <td>
                                <button onclick='editActivity(" . $row["id"] . ")'>Editar</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron resultados de actividades</td></tr>";
            }
            ?>
        </table>
        <button onclick="showForm('add_activity_form')">Agregar Actividad</button>

        <div id="edit_activity_form" class="modal">
            <div class="modal-content">
                <span class="close" onclick="hideForm('edit_activity_form')">&times;</span>
                <h3>Editar Actividad</h3>
                <form method="post" action="../controller/editar_actividad.php">
                    <input type="hidden" id="edit_activity_id" name="id">
                    Tipo: <input type="text" id="edit_activity_type" name="type"><br>
                    Título: <input type="text" id="edit_activity_title" name="title"><br>
                    Descripción: <input type="text" id="edit_activity_description" name="description"><br>
                    <input type="submit" value="Guardar">
                </form>
            </div>
        </div>

        <div id="add_activity_form" style="display: none;">
            <h3>Agregar Actividad</h3>
            <form method="post" action="../controller/agregar_actividad.php">
                Tipo: <input type="text" id="add_activity_type" name="type"><br>
                Título: <input type="text" id="add_activity_title" name="title"><br>
                Descripción: <input type="text" id="add_activity_description" name="description"><br>
                <input type="submit" value="Guardar">
            </form>
        </div>
    </div>
</div>

<script>
    function showForm(formId) {
        document.getElementById(formId).style.display = 'block';
    }

    function hideForm(formId) {
        document.getElementById(formId).style.display = 'none';
    }

    function toggleSection(sectionId) {
        var resourcesSection = document.getElementById('resources');
        var activitiesSection = document.getElementById('activities');

        if (sectionId === 'resources') {
            resourcesSection.classList.add('active-section');
            resourcesSection.classList.remove('inactive-section');
            activitiesSection.classList.add('inactive-section');
            activitiesSection.classList.remove('active-section');
        } else if (sectionId === 'activities') {
            activitiesSection.classList.add('active-section');
            activitiesSection.classList.remove('inactive-section');
            resourcesSection.classList.add('inactive-section');
            resourcesSection.classList.remove('active-section');
        }
    }

    function editResource(id) {
        var row = document.querySelector(`#resources_table tr[data-id="${id}"]`);
        var type = row.cells[0].innerText;
        var title = row.cells[1].innerText;
        var description = row.cells[2].innerText;

        document.getElementById("edit_resource_id").value = id;
        document.getElementById("edit_resource_type").value = type;
        document.getElementById("edit_resource_title").value = title;
        document.getElementById("edit_resource_description").value = description;

        showForm('edit_resource_form');
    }

    function editActivity(id) {
        var row = document.querySelector(`#activities_table tr[data-id="${id}"]`);
        var type = row.cells[0].innerText;
        var title = row.cells[1].innerText;
        var description = row.cells[2].innerText;

        document.getElementById("edit_activity_id").value = id;
        document.getElementById("edit_activity_type").value = type;
        document.getElementById("edit_activity_title").value = title;
        document.getElementById("edit_activity_description").value = description;

        showForm('edit_activity_form');
    }
</script>

</body>
</html>





