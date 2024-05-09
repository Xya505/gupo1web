<?

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Plataforma Educativa</title>
   
    <link href="../css/pltaformadoc.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-xxxxxx" crossorigin="anonymous" />

</head>
<body>
    <header>
    <button onclick="goBack()" class="back-button"><i class="fas fa-arrow-left"></i>  </button>
    <h1>Bienvenido a la Plataforma Educativa</h1>
    <div class="actividad"></div>
</header>


<main>
    <section class="perfil">
        <div class="perfil-info">
            <img src="../recurso/img plataforma/ingles prof.jpg" alt="">
            <h2>Alber Gonzales</h2>
        </div>
        <div class="editar">
            
            <div class="opciones-editar">
                <select id="opcionesEditar" onchange="redireccionar()">
                    <option value="">Editar perfil</option>
                    <option value="edit">Ver  información</option>
                    <option value="cambiar-contra">Cambiar contraseña</option>
                    <option value="cerrar-cuenta">Cerrar cuenta</option>
                </select>
            </div>
        </div>
    </section>
    
    <section class="clases">
        <div class="clase">
            <img src="../recurso/img plataforma/ingles.png" alt="">
            <h3>Matemáticas 3 año</a></h3>
            <p><a href="../pdocente/agg.php">Agregar/eliminar  Estudiante</a> </p>
            <p><a href="../pdocente/docenteagg.">Agregar/eliminar tarea</a></p>
        </div>
    
</main>

<footer>
    <p>Derechos de Autor © 2023 - Kevin_Paizano</p>
</footer>

<div class="icono-ayuda">
    <i class="fas fa-question-circle"></i>
    <img src="../recurso/img plataforma/ayuda.png" alt="Ayuda">
</div>

<script>
    function redireccionar() {
      var seleccion = document.getElementById("opcionesEditar").value;
      if (seleccion === "cerrar-cuenta") 
      {
        window.location.href = "index.php";
      }
      if (seleccion === "cambiar-contra")
      {
        window.location.href = "cambiarcontra.html";
      }
      if (seleccion === "edit")
      {
        window.location.href = "info.php";
      }

    }
  </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/sweet.js"></script>
</body>
</html>
