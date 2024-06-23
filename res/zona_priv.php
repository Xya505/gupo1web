<?php
    session_start();

    if(!isset($_SESSION['autenticado'])){
        header("Location: /login.php");

        if (!defined('INCLUSION_PERMITIDA')) {
            exit('Acceso denegado');
        }
    }