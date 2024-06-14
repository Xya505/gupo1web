<?php
    if($_SESSION['autenticado']['rol']==1){
?>
        <div class="container-fluid mx-auto">
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 fixed-top">
        <div class="container-fluid">
        <a class="navbar-brand" href="/">XSTREAMING</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav w-100">
        <li class="nav-item">
            <a class="nav-link" href="/views/client.view.php"><i class="bi bi-person"></i> Tareas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/views/usuarios.view.php"><i class="bi bi-play-fill"></i> Usuarios</a>
        </li>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-gear me-2"></i><?= $_SESSION['autenticado']['nombre_completo'];?>
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

    <?php

}else {
?>

        <div class="container-fluid mx-auto">
            <nav class="navbar navbar-expand-lg navbar-light bg-light px-5 fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">XSTREAMING</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item">
                                <a class="nav-link" href="/views/client.view.php"><i class="bi bi-person"></i> Cursos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/views/platforms.view.php"><i class="bi bi-play-fill"></i> Tareas</a>
                            </li>
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-gear me-2"></i><?= $_SESSION['autenticado']['nombre_completo'];?>
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

        <?php

    }
    ?>
<br>
<br>
<br>

<?php
include_once "logout_modal.php";
