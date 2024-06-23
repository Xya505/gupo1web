<?php include_once "res/header.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: rgba(to right, #6a11cb, #2575fc); /* Fondo blanco con opacidad */
            padding: 2rem;
            border-radius: 1rem; /* Bordes redondeados */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); /* Sombra */
        }
        .login-header img {
            display: block;
            margin: 0 auto;
            max-width: 100px;
        }
        .login-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        .login-header p {
            font-size: 1rem;
            font-weight: 400;
            margin-top: 0;
            text-align: center;
        }
        .btn-primary {
            background-color: #1a237e;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <img src="res/img/logo.png" alt="Logo" style="max-width: 100px;">
                    <h2>Colegio Rigoberto López Pérez</h2>
                </div>
                <form action="/controllers/auth.controller.php" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de Usuario" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Acceder</button>
                </form>
    
            </div>
        </div>
    </div>
</body>
</html>


<?php include_once "res/footer.php";


?>
