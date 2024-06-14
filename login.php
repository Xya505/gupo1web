<?php include_once "res/header.php"; ?>

<br>
<br>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">AUTENTICACIÓN PLATAFORMA</h2>
            <br>
            <form action="/controllers/auth.controller.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de Usuario</label>
                    <input type="email" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
</div>


<?php include_once "res/footer.php";

echo hash('sha512', "1234");
?>
