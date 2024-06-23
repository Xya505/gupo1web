<!-- Modal para modificar usuario -->
<div class="modal fade" id="modalModificarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalModificarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../controllers/usuarios.controller.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarUsuarioLabel">Modificar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="modificarIdUsuario">
                    <input type="hidden" name="action" id="modificarAction" value="edit">
                    <div class="form-group">
                        <label for="modificar_nombre_completo">Nombre Completo</label>
                        <input type="text" class="form-control" id="modificar_nombre_completo" name="nombre_completo" required>
                    </div>
                    <div class="form-group">
                        <label for="modificar_correo">Correo</label>
                        <input type="email" class="form-control" id="modificar_correo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="modificar_rol">Rol</label>
                        <select class="form-control" id="modificar_rol" name="rol" required>
                            <option value="1">Administrador</option>
                            <option value="2">Estudiante</option>
                            <option value="3">Profesor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="modificar_imagen">Imagen</label>
                        <input type="file" class="form-control" id="modificar_imagen" name="imagen">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Capturar el clic en el botón Modificar
        $('#MiTabla').on('click', '.btn-modificar', function() {
            // Obtener datos del usuario seleccionado
            var idUsuario = $(this).closest('tr').find('.usuario-id').text();
            var nombreCompleto = $(this).closest('tr').find('.usuario-nombre').text();
            var correo = $(this).closest('tr').find('.usuario-correo').text();
            var rol = $(this).closest('tr').find('.usuario-rol').data('rol');

            // Asignar valores al modal de modificar usuario
            $('#modificarIdUsuario').val(idUsuario);
            $('#modificar_nombre_completo').val(nombreCompleto);
            $('#modificar_correo').val(correo);
            $('#modificar_rol').val(rol);

            // Mostrar el modal de modificar usuario
            $('#modalModificarUsuario').modal('Pagina');
        });
    });
</script>
