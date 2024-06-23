<?php
include "../res/zona_priv.php";
include "../models/usuarios.model.php";

$objUsuario = new Usuarios();

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    
    // Verificar si se ha seleccionado un archivo de imagen
    if (!empty($_FILES['imagen']['tmp_name'])) {
        $imagen = base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
    } else {
        $imagen = ''; // Otra acción si no se selecciona ninguna imagen
    }

    if ($objUsuario->updateUser($id, $nombre, $correo, $rol, $imagen)) {
        header("Location: usuarios.view.php?mensaje=Usuario modificado correctamente");
    } else {
        header("Location: usuarios.view.php?mensaje=Error al modificar el usuario");
    }
} else if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $usuario = $objUsuario->getUserById($id);
    if ($usuario) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Editar Usuario</h2>
    <form action="editar_usuario.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $usuario['id']; ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario['nombre_completo']; ?>" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" value="<?= $usuario['correo']; ?>" required>
        </div>
        <div class="form-group">
            <label for="rol">Rol:</label>
            <select class="form-control" id="rol" name="rol" required>
                <option value="1" <?= $usuario['rol'] == 1 ? 'selected' : ''; ?>>Administrador</option>
                <option value="2" <?= $usuario['rol'] == 2 ? 'selected' : ''; ?>>Estudiante</option>
                <option value="3" <?= $usuario['rol'] == 3 ? 'selected' : ''; ?>>Profesor</option>
            </select>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
</body>
</html>
<?php
    } else {
        header("Location: usuarios.view.php?mensaje=Usuario no encontrado");
    }
} else {
    header("Location: usuarios.view.php?mensaje=ID de usuario no especificado");
}
?>

