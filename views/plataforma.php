<?php
     session_start();
     if(!isset($_SESSION['usuario'])){
      echo '
  
   <script>
      alert("Por favor debes iniciar sesión");
      </script>
  ';
    header("location: login.php");
      session_destroy();
      die();
  
     }
     session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Plataforma Educativa</title>
  <link href="../css/plataforma.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-o51bD0HTtJp0LsFGG1+3w8VRp7vC9+zl7X8dLqPU5HOZUnwcJhDSKWXQlQ5Ase9/+BPLy+V/n9/Gc1d6Fb4gMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <header>
    <div class="atras">
      <button onclick="goBack()">
        <i class="fas fa-arrow-left"></i>
      </button>
    </div>
    <h1>Bienvenido a la Plataforma Educativa</h1>
    <div class="actividad"></div>
  </header>

  <main>
    <section class="perfil">
      <div class="perfil-info">
        <img src="../recurso/img plataforma/estudiante pla.png" alt="Imagen del estudiante">
        <h2>Amara Polo</h2>
        <p>Descripción del estudiante.</p>
      </div>
      <div class="editar">
        <div class="opciones-editar">
          <select id="opcionesEditar" onchange="redireccionar()">
            <option value=""> <span>Editar perfil</span></option>
            <option value="edit">ver información </option>
            <option value="cambiar-contra">Cambiar contraseña</option>
            <option value="cerrar-cuenta">Cerrar Sesión</option>
          </select>
        </div>
      </div>
    </section>

    <section class="clases">
      <div class="clase">
        <img src="../recurso/img plataforma/matematica.png" alt="Imagen de Matemáticas">
        <h3><a href="../plataforma/plataforma 0.1.php">Matemáticas 3 año</a></h3>
        <p>Profesor Monky D. Luffy</p>
        <p>Horario: Lunes y Miércoles, 10:00 AM - 12:00 PM</p>
      </div>
      <div class="clase">
        <img src="../recurso/img plataforma/ingles.png" alt="Imagen de Inglés">
        <h3><a href="../plataforma/plataforma 0.1.php"><span>Inglés 3 año</span></a></h3>
        <p>Profesor Cris Braun</p>
        <p>Horario: Martes y Jueves, 2:00 PM - 4:00 PM</p>
      </div>
    </section>
  </main>

  <footer>
    <p>Derechos de Autor © 2023 - Kevin_Paizano</p>
  </footer>

  <div class="icono-ayuda">
    <i class="fas fa-question-circle"></i>
    <img src="recurso/img plataforma/ayuda.png" alt="Ayuda">
  </div>

  <script>
    function goBack() {
      window.history.back();
    }

    function redireccionar() {
      var seleccion = document.getElementById("opcionesEditar").value;
      if (seleccion === "cerrar-cuenta") {
        window.location.href = "index.php";
      } else if (seleccion === "cambiar-contra") {
        window.location.href = "cambiarcontra.html";
      } else if (seleccion === "edit") {
        window.location.href = "info.html";
      }
    }

    function mostrarAlertaBienvenida() {
      Swal.fire({
        icon: 'success',
        title: '¡Bienvenid@!',
        text: 'Gracias por visitar nuestra plataforma educativa.',
        confirmButtonText: 'Aceptar'
      });
    }

    window.onload = function() {
      mostrarAlertaBienvenida();
    };
  </script>

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
