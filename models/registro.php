<?php
include '../controller/conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST["nombre_completo"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"];
    $contrasena = hash('sha512', $contrasena);

    if (isset($_FILES['imagen']) && $_FILES['imagen']['tmp_name'] != '') {
        $imagen = $_FILES['imagen']['tmp_name'];
        $imagen_binaria = file_get_contents($imagen);
    } else {
        $imagen_binaria = NULL;
    }

    $sql = "INSERT INTO usuarios (nombre_completo, correo, contrasena, rol, imagen) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssis", $nombre_completo, $correo, $contrasena, $rol, $imagen_binaria);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>window.location.href = 'registro.php';</script>";
        exit();
    } else {
        echo "Error al agregar usuario: " . mysqli_error($conexion);
    }
    mysqli_stmt_close($stmt);
}

if (isset($_GET["eliminar_usuario"])) {
    $id_usuario = filter_var($_GET["eliminar_usuario"], FILTER_SANITIZE_NUMBER_INT);
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>window.location.href = 'registro.php';</script>";
        exit();
    } else {
        echo "Error al eliminar usuario: " . mysqli_error($conexion);
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="../css/envios.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
</head>
<body>

<h2>Lista de Usuarios</h2>

<div class="search-box">
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Buscar por nombre o correo">
</div>
<form id="addUserForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <input type="file" name="imagen" accept="image/*" required>
    <input type="text" name="nombre_completo" placeholder="Nombre completo" required>
    <input type="text" name="correo" placeholder="Correo" required>
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <select name="rol" required>
        <option value="">Seleccione un rol</option>
        <option value="1">Administrador</option>
        <option value="2">Estudiante</option>
    </select>
    <button type="submit">Agregar Usuario</button>
</form>

<table id="userTable">
    <tr>
        <th>Imagen</th>
        <th>Nombres</th>
        <th>Correo</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
    <?php
    $result = mysqli_query($conexion, "SELECT * FROM usuarios");
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $imagen = $row['imagen'] ? "<img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' height='50' width='50'>" : "No imagen";
                echo "<tr>
                    <td>" . $imagen . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["correo"] . "</td>
                    <td>" . $row["usuario"] . "</td>
                    <td>" . $row["contrasena"] . "</td>
                    <td>" . $row["rol"] . "</td>
                    <td>
                        <button onclick=\"editUser('" . $row['id'] . "')\">Editar</button>
                        <button onclick=\"deleteUser('" . $row['id'] . "')\">Eliminar</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No se encontraron resultados</td></tr>";
        }
        mysqli_free_result($result);
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
    ?>
</table>

<script>
    function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("userTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; 
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function deleteUser(userId) {
        if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
            window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?eliminar_usuario=" + userId;
        }
    }

    function editUser(userId) {
 
    var actionButtons = document.querySelectorAll("#userTable button");

  
    actionButtons.forEach(function(button) {
        button.classList.add("opaque");
    });

    {
    
    window.location.href = "../controller/editar_usuario.php?id=" + userId;
}

}

</script>

</body>
</html>







