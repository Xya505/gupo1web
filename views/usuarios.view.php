<?php
include "../res/zona_priv.php";
include_once "../res/header.php";
include_once "../res/menu.php";
include "../models/usuarios.model.php";

$objUsuario = new Usuarios();

?>
<h2>Tabla de Usuarios</h2>
<br>
<?php include "usuarios.forms.view.php";?>
<div class="container mt-5">


    <!-- Envolver la tabla con.table-responsive para hacerla responsiva -->
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

                while($usuario = mysqli_fetch_assoc($resultados)){
            ?>
            <tr>
                <td><?= $usuario['nombre_completo'];?></td>
                <td><?= $usuario['correo'];?></td>
                <td><?php
                        if($usuario['rol'] == "1"){
                            echo "Administrador";
                        }else {
                            echo "Estudiante";
                        }
                    ?></td>
                <td>
                    <?php
                    // Utiliza el operador de fusión null para asegurarse de que no se pase null a base64_decode()
                    $rutaImagenUsuario = base64_decode(isset($usuario['imagen']) ? $usuario['imagen'] : '../res/img/users.png');

                    // Ahora puedes proceder con la verificación de existencia del archivo sin preocuparte por recibir null
                    if (file_exists($rutaImagenUsuario)) {
                        echo '<img class="img-fluid rounded float-start" src="'. $rutaImagenUsuario. '" alt="Imagen de Usuario" style="max-width:50px;">';
                    } else {
                        // Ruta de la imagen predeterminada
                        $rutaImagenPredeterminada = "../res/img/users.png";
                        echo '<img class="img-fluid rounded float-start" src="'. $rutaImagenPredeterminada. '" alt="Imagen Predeterminada de Usuario" style="max-width:50px;">';
                    }
                    ?>

                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm">Modificar</button>
                    <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>
            <?php
                }
            ?>
            </tbody>
            <tfoot>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
                <th scope="col">Imagen</th>
                <th scope="col">Opciones</th>
            </tfoot>
        </table>
    </div>
</div>
<br>
<br>
<br>


<?php include_once "../res/footer.php"; ?>
