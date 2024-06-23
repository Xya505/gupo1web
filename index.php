<?php
define('INCLUSION_PERMITIDA', true);

include_once "res/zona_priv.php";
include_once "res/header.php";
include_once "res/menu.php";
?>

<div class="container">
            <h2 class="text-center">RIGOBERTO LÓPEZ PÉREZ</h2>
    <h3 class="mt-3 mb-3"></h3>

</div>
<div class="container mt-5 pt-5">
        <style>
            .image-container {
                position: relative;
                width: 100%;
                max-width: 800px;
                margin: 0 auto;
            }

            .school-img {
                width: 100%;
                height: auto;
                border-radius: 10px;
                object-fit: cover;
                transition: opacity 0.5s ease;
            }

            .description {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgba(0, 0, 0, 0.7);
                color: white;
                padding: 20px;
                border-radius: 10px;
                opacity: 0;
                transition: opacity 0.5s ease;
                text-align: center;
            }

            .image-container:hover .description {
                opacity: 1;
            }

            .image-container:hover .school-img {
                opacity: 0.3;
            }
        </style>
        
        <!-- Descripción del Colegio -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="image-container">
                    <img src="res/img/c.jpg" alt="Rigoberto López Pérez" class="school-img">
                    <div class="description">
                        Rigoberto López Pérez es una institución educativa comprometida con la excelencia académica y el desarrollo integral de nuestros estudiantes.
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Misión y Visión -->
        <div class="row mb-5">
            <div class="col-md-6">
                <h2>Misión</h2>
                <p>Nuestra misión es proporcionar una educación de calidad que fomente el desarrollo intelectual, emocional y social de nuestros estudiantes.</p>
            </div>
            <div class="col-md-6">
                <h2>Visión</h2>
                <p>Nuestra visión es ser reconocidos como una institución líder en educación, formando ciudadanos responsables y comprometidos con la sociedad.</p>
            </div>
        </div>

        <!-- Galería de Imágenes -->
        <div class="row mb-5">
            <div class="col-12">
                <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-item img {
            width: 60%; 
            height: 70vh; 
            object-fit: cover; 
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="text-center">El esfuerzo es el fruto del mañana.</h2>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/res/img/6.jpg" class="d-block w-100" alt="Imagen 1">
                        </div>
                        <div class="carousel-item">
                            <img src="../res/img/1.jpeg" class="d-block w-100" alt="Imagen 2">
                        </div>
                        <div class="carousel-item">
                            <img src="../res/img/4.jpeg" class="d-block w-100" alt="Imagen 3">
                        </div>
                        <div class="carousel-item">
                            <img src="../res/img/3.jpeg" class="d-block w-100" alt="Imagen 4">
                        </div>
                        <div class="carousel-item">
                            <img src="../res/img/f2.jpg" class="d-block w-100" alt="Imagen 4">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

        <!-- Profesores y Estudiantes Destacados -->
        <div class="row mb-5">
    <style>
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
    </style>
    <div class="col-md-6">
        <h2>Profesores</h2>
        <ul>
            <li>
                <img src="res/img/mate.jpg" alt="Prof. Juan Pérez" class="profile-img">
                Prof. Juan Pérez - Matemáticas
            </li>
            <li>
                <img src="res/img/ciencia.jpg" alt="Prof. María López" class="profile-img">
                Prof. María López - Ciencias
            </li>
            <li>
                <img src="res/img/historia.jpg" alt="Prof. Ana Gómez" class="profile-img">
                Prof. Ana Gómez - Historia
            </li>
        </ul>
    </div>
    <div class="col-md-6">
        <h2>Estudiantes Destacados</h2>
        <ul>
            <li>
                <img src="res/img/mandi.jpeg" alt="Mandi González" class="profile-img">
                Mandi González - Mejor Promedio
            </li>
            <li>
                <img src="res/img/k.png" alt="Laura Ramírez" class="profile-img">
                Katya Ramírez - Mejor Deportista
            </li>
            <li>
                <img src="res/img/pep.jpg" alt="Carlos Sánchez" class="profile-img">
                Carlos Sánchez - Mejor en Arte
            </li>
        </ul>
    </div>
</div>

        <!-- Fiestas Patrias -->
        <div class="container mt-5 pt-5">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
        <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .gallery-item {
            margin: 10px;
        }

        .gallery-item img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .gallery-item img:hover {
            transform: scale(1.1);
        }
    </style>

        <div class="row mb-5">
            <div class="col-12">
                <h2 class="text-center">Fiestas Patrias</h2>
                <p>Nuestras celebraciones de Fiestas Patrias son un evento anual que destaca la cultura y tradiciones de nuestro país. Los estudiantes participan en desfiles, bailes y otras actividades culturales.</p>
            </div>
        </div>

        <div class="row">
            <div class="gallery">
                <div class="col-md-4 gallery-item">
                    <a href="res/img/f1.jpg" data-lightbox="fiestas-patrias" data-title="Descripción de la imagen 1">
                        <img src="res/img/f1.jpg" alt="Fiesta Patria 1">
                    </a>
                </div>
                <div class="col-md-4 gallery-item">
                    <a href="res/img/f2.jpg" data-lightbox="fiestas-patrias" data-title="Descripción de la imagen 2">
                        <img src="res/img/f2.jpg" alt="Fiesta Patria 2">
                    </a>
                </div>
                <div class="col-md-4 gallery-item">
                    <a href="res/img/f3.jpg" data-lightbox="fiestas-patrias" data-title="Cantan y Bailan xd">
                        <img src="res/img/f3.jpg" alt="Fiesta Patria 3">
                    </a>
                </div>
                <!-- Agrega más div.gallery-item según sea necesario -->
            </div>
        </div>
        
    </div>

        <!-- Ubicación -->
        <div class="container">
        <h2 class="text-center">Ubicación del Colegio</h2>
       <iframe  
       src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3900.9129234544134!2d-86.27803262589335!3d12.118110233017324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f7155eaf4bf89bf%3A0xc8ffd139ef2447db!2sInstituto%20Nacional%20Rigoberto%20L%C3%B3pez%20P%C3%A9rez!5e0!3m2!1ses!2sni!4v1718912678966!5m2!1ses!2sni" 
       
       width="100%"
       height="500px" 
       max-width="800px"
       border-radius="10px"
       margin="0 auto" 
       ></iframe>  
        <!-- Horarios de Atención y Contacto -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="text-center">Horarios de Atención</h2>
                <p>Lunes a Viernes: 8:00 AM - 4:00 PM</p>
                <p>Teléfono: (505) 456-7890</p>
                <p>Email: rigobertolopez@yahoo.com</p>
                <p>Redes Sociales: 
                    <a href="#"><i class="bi bi-facebook"></i> Facebook</a> | 
                    <a href="https://chat.whatsapp.com/I5jujHzhD8s2acLD3ZZsF2"><i class="bi bi-whatsapp"></i> Whatsapp</a> | 
                    <a href="#"><i class="bi bi-instagram"></i> Instagram</a>
                </p>
            </div>
        </div>

        <!-- Director -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2>Director</h2>
                <li>
                <img src="res/img/mate.jpg" alt="Mandi González" class="profile-img">
                Dr. Juan Pérez - Director del Colegio
            </li>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include_once "res/footer.php"; ?>
