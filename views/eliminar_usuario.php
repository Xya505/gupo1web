<?php
include "../res/zona_priv.php";
include "../models/usuarios.model.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $objUsuario = new Usuarios();
    if ($objUsuario->deleteUser($id)) {
        header("Location: usuarios.view.php?mensaje=Usuario eliminado correctamente");
    } else {
        header("Location: usuarios.view.php?mensaje=Error al eliminar el usuario");
    }
} else {
    header("Location: usuarios.view.php?mensaje=ID de usuario no especificado");
}
?>

