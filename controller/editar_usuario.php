<?php
include '../controller/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nombre_completo = $_POST["nombre_completo"];
    $correo = $_POST["correo"];
    $rol = $_POST["rol"];

   
    if (isset($_FILES['imagen']) && $_FILES['imagen']['tmp_name'] != '') {
        $imagen = $_FILES['imagen']['tmp_name'];
        $imagen_binaria = file_get_contents($imagen);
        $sql = "UPDATE usuarios SET nombre_completo=?, correo=?, rol=?, imagen=? WHERE id=?";
        $stmt = mysqli_prepare($conexion, $sql);
        
        mysqli_stmt_bind_param($stmt, "sssbi", $nombre_completo, $correo, $rol, $imagen_binaria, $id);
    } else {
        
        $sql = "UPDATE usuarios SET nombre_completo=?, correo=?, rol=? WHERE id=?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $nombre_completo, $correo, $rol, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        
        header("Location: ../models/registro.php");
        exit();
    } else {
        echo "Error al actualizar usuario: " . mysqli_error($conexion);
    }
    mysqli_stmt_close($stmt);
} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM usuarios WHERE id=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
} else {
   
    header("Location: ../models/registro.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/envios.css">
</head>
<body>

<h2>Editar Usuario</h2>

<form method="post" action="editar_usuario.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
   
    <img src="data:image/jpeg;base64,<?php echo base64_encode($usuario['imagen']); ?>" height="150" width="150" alt="Imagen actual">
    
    <input type="file" name="imagen" accept="image/*">
    <input type="text" name="nombre_completo" value="<?php echo $usuario['nombre_completo']; ?>" placeholder="Nombre completo" required>
    <input type="text" name="correo" value="<?php echo $usuario['correo']; ?>" placeholder="Correo" required>
    <select name="rol" required>
        <option value="1" <?php if ($usuario['rol'] == 1) echo 'selected'; ?>>Administrador</option>
        <option value="2" <?php if ($usuario['rol'] == 2) echo 'selected'; ?>>Estudiante</option>
    </select>
    <button type="submit">Actualizar Usuario</button>
</form>

</body>
</html>




