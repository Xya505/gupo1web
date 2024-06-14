<?php
session_start();
    include "../models/usuarios.model.php";

    if(isset($_POST["username"]) && isset($_POST["password"])){
        $usuario = new Usuarios();
        $correo = $_POST["username"];
        $constrasena = hash('sha512', $_POST["password"]);

        $usuario->usuario = $correo;
        $usuario->contrasena = $constrasena;

        $resultado = $usuario->authenticate();

        if(mysqli_num_rows($resultado)>0){
            $usuarioautenticado = mysqli_fetch_array($resultado);
            $_SESSION['autenticado'] = $usuarioautenticado;
            header("Location: ../index.php");
        }
    }
