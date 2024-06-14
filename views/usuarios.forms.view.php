<div class="container">

<div class="d-flex justify-content-end gap-2">
    <!-- Nuevo Botón Agregar Cliente con Icono de Sign Plus -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClientModal">
        <i class="bi bi-plus"></i>
        Agregar Usuario
    </button>

</div>

<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="/controllers/client.controller.php" method="post">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Apellido:</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Ingrese el apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Ingrese el teléfono" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Cliente</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

</div>

<br><br>