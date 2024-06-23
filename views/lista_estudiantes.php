<?php
require "../res/zona_priv.php";
include_once "../res/header.php";
include_once "../res/menu.php";
include '../models/conexion.model.php';
require_once('../fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta según tu configuración

// Crear una instancia de la clase Conexion
$conexion = new Conexion();

// Obtener la conexión
$conn = $conexion->getConnection();

// Procesar agregar estudiante
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $rol = 2; // Rol de estudiante

    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['tmp_name']) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    }

    // Hashing de la contraseña con SHA-512
    $sha512_password = hash('sha512', $password);
    
    // Hashing de la contraseña con password_hash después de aplicar SHA-512
    $hashed_password = password_hash($sha512_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO estudiante (nombre, correo, rol, contrasena, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $nombre, $correo, $rol, $hashed_password, $imagen);
    $stmt->execute();
    $stmt->close();
}

// Procesar eliminar estudiante
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
    $id = $_POST['id'];

    // Eliminar estudiante
    $stmt = $conn->prepare("DELETE FROM estudiante WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT e.id, e.nombre, e.correo, e.rol, e.imagen, p.descripcion AS rol_descripcion
        FROM estudiante e
        JOIN permisos p ON e.rol = p.id";

// Ejecutar la consulta y manejar los errores si los hay
if ($result = $conn->query($sql)) {
    // La consulta fue exitosa, procedemos con el resto del código
} else {
    // La consulta falló, mostramos el error
    echo "Error en la consulta: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .formulario {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            z-index: 9999;
        }

        .opaco {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Estudiantes</h1>

        <!-- Botón de agregar estudiante -->
        <button class="btn btn-primary mb-3" onclick="mostrarFormulario('agregar')">Agregar Estudiante</button>
        <button class="btn btn-secondary mb-3" onclick="descargarPDF()">Descargar como PDF</button>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['correo']}</td>
                                <td>{$row['rol_descripcion']}</td>
                                <td>";
                        if ($row['imagen']) {
                            echo "<img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' style='max-width:45px;'>";
                        }
                        echo "</td>
                                <td>
                                    <button class='btn btn-primary' onclick='mostrarFormulario(\"modificar\", {$row['id']})'>Modificar</button>
                                    <form method='post' action=''>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <input type='submit' class='btn btn-danger' name='eliminar' value='Eliminar'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay estudiantes registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div id="formulario-agregar" class="formulario" style="display: none;">
            <h2>Agregar Estudiante</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                <input type="email" class="form-control" name="correo" placeholder="Correo" required>
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                <input type="file" class="form-control" name="imagen">
                <input type="submit" class="btn btn-primary" name="agregar" value="Agregar">
            </form>
        </div>

        <div id="formulario-modificar" class="formulario">
            <h2>Modificar Estudiante</h2>
            <form id="form-modificar" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" id="id-modificar" name="id">
                <input type="text" class="form-control" name="nombre" placeholder="Nuevo nombre">
                <input type="email" class="form-control" name="correo" placeholder="Nuevo correo">
                <input type="file" class="form-control" name="imagen">
                <input type="submit" class="btn btn-primary" name="modificar" value="Modificar">
            </form>
        </div>

        <div id="opaco" class="opaco"></div>
    </div>

    <script>
        function mostrarFormulario(accion, id = null) {
            document.getElementById('formulario-' + accion).style.display = 'block';
            document.getElementById('opaco').style.display = 'block';
            if (accion === 'modificar') {
                document.getElementById('id-modificar').value = id;
            }
        }

        function descargarPDF() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'generar_pdf.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.responseType = 'blob';

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var blob = new Blob([xhr.response], { type: 'application/pdf' });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'lista_estudiantes.pdf';
                    link.click();
                }
            };

            xhr.send();
        }

        document.getElementById('opaco').addEventListener('click', function() {
            document.getElementById('formulario-agregar').style.display = 'none';
            document.getElementById('formulario-modificar').style.display = 'none';
            document.getElementById('opaco').style.display = 'none';
        });
    </script>
</body>
</html>

<?php include_once "../res/footer.php"; ?>









