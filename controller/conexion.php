<?php

   $conexion = mysqli_connect("localhost","root","","login");

   if ($conexion) 
   {
      echo "Conectado exitosamente a la Base de datos";
   }
   else {
      echo "NO se a podido conectar";
   }


