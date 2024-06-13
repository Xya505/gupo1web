<?php
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

        <main>

            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>.</h3>
                        <p>.</p>
                       
                    </div>
                    <div class="caja__trasera-register">
                       
                    </div>
                </div>

                
                <div class="contenedor__login-register">
                   
                    <form action="../controller/login_usuario.php" method="POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="text" placeholder="Correo" name="correo">
                        <input type="password" placeholder="Contraseña" name="contrasena">
                        <button><a href=""></a>Entrar</button>
                    </form>

                   
                    
                </div>
            </div>

        </main>

        <script src="assets/js/script.js"></script>
        <script src="assets/js/jaja.js"></script>
</body>
</html>