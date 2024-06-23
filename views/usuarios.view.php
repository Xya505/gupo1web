<?php
include "../res/zona_priv.php";
include_once "../res/header.php";
include_once "../res/menu.php";
include "../models/usuarios.model.php";

$objUsuario = new Usuarios();
?>
<h2>Tabla de Usuarios</h2>
<br>
<?php include "usuarios.forms.view.php"; ?>
<div class="container mt-5">
    <a href="agregar_usuario.php" class="btn btn-success mb-3">Agregar Usuario</a>
    <br>
    <div class="table-responsive">
        <table class="table" id="MiTabla">
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
                <th scope="col">Imagen</th>
                <th scope="col">Opciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $resultados = $objUsuario->getAllUsers();

            while ($usuario = mysqli_fetch_assoc($resultados)) {
                ?>
                <tr>
                    <td><?= $usuario['nombre_completo']; ?></td>
                    <td><?= $usuario['correo']; ?></td>
                    <td>
                        <?php
                        if ($usuario['rol'] == "1") {
                            echo "Administrador";
                        } elseif ($usuario['rol'] == "2") {
                            echo "Estudiante";
                        } else {
                            echo "Profesor";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($usuario['imagen'])) {
                            echo '<img class="img-fluid rounded float-start" src="data:image/jpeg;base64,' . base64_encode($usuario['imagen']) . '" alt="Imagen de Usuario" style="max-width:45px;">';
                        } else {
                            $rutaImagenPredeterminada = "../res/img/ichigo.png";
                            echo '<img class="img-fluid rounded float-start" src="' . $rutaImagenPredeterminada . '" alt="Imagen Predeterminada de Usuario" style="max-width:45px;">';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="editar_usuario.php?id=<?= $usuario['id']; ?>" class="btn btn-primary btn-sm">Modificar</a>
                        <a href="eliminar_usuario.php?id=<?= $usuario['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
                <th scope="col">Imagen</th>
                <th scope="col">Opciones</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<br><br><br>

<?php include_once "../res/footer.php"; ?>
