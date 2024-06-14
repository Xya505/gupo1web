<?php
    include "conexion.model.php";
class Usuarios{
    private $con;
    public $usuario;
    public $contrasena;

    public function __construct(){
        $this->con = new Conexion();
    }

    public function authenticate(){
        $consulta = "select * from usuarios where correo = '$this->usuario' and contrasena = '$this->contrasena'";
        return $this->con->consultar($consulta);
    }

    public function getAllUsers(){
        $consulta = "select * from usuarios";
        return $this->con->consultar($consulta);
    }

    //crear la función para agregar usuario

}
