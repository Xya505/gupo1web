<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['autenticado']) || !is_array($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

$rol = $_SESSION['autenticado']['rol'];
$nombre_completo = $_SESSION['autenticado']['nombre_completo'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación de Estudiantes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <?php if ($rol == 1) { ?>
    <div class="container-fluid mx-auto">
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">RIGOBERTO LÓPEZ PÉREZ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item">
                            <a class="nav-link" href="../views/usuarios.view.php"><i class="bi bi-play-fill"></i> Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/views/cursos.php"><i class="bi bi-person"></i> Cursos</a>
                        </li>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear me-2"></i><?= htmlspecialchars($nombre_completo); ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-eye me-2"></i>Ver Datos</a></li>
                                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#cerrarsesion"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php } elseif ($rol == 2) { ?>
    <div class="container-fluid mx-auto">
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">RIGOBERTO LÓPEZ PÉREZ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item">
                            <a class="nav-link" href="/views/mis.cursos.php"><i class="bi bi-person"></i>Mis Cursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/views/actividades.view.php?curso_id=1"><i class="bi bi-play-fill"></i> Actividades</a>
                        </li>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear me-2"></i><?= htmlspecialchars($nombre_completo); ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-eye me-2"></i>Ver Datos</a></li>
                                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#cerrarsesion"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php } elseif ($rol == 3) { ?>
    <div class="container-fluid mx-auto">
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">RIGOBERTO LÓPEZ PÉREZ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-100">
                        <li class="nav-item">
                            <a class="nav-link" href="/views/cursos.php"><i class="bi bi-person"></i> Cursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/views/tareas.view.php"><i class="bi bi-play-fill"></i> Tareas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/views/lista_estudiantes.php"><i class="bi bi-play-fill"></i> Estudiantes</a>
                        </li>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear me-2"></i><?= htmlspecialchars($nombre_completo); ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-eye me-2"></i>Ver Datos</a></li>
                                    <li><a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#cerrarsesion"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php } ?>
    
    <?php include_once "logout_modal.php"; ?>
</body>
</html>









