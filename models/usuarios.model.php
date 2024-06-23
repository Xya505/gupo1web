<?php
include "conexion.model.php";

class Usuarios {
    private $con;

    public function __construct(){
        $this->con = new Conexion();
    }

    public function authenticate($correo, $contrasena){
        $consulta = $this->con->prepare("SELECT * FROM usuarios WHERE correo = ? AND contrasena = ?");
        $consulta->bind_param("ss", $correo, $contrasena);
        $consulta->execute();
        return $consulta->get_result();
    }

    public function getAllUsers(){
        $consulta = "SELECT * FROM usuarios";
        return $this->con->consultar($consulta);
    }

    public function addUser($nombre, $correo, $rol, $imagen, $contrasena) {
        $sql = "INSERT INTO usuarios (nombre_completo, correo, rol, imagen, contrasena) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssiss", $nombre, $correo, $rol, $imagen, $contrasena);
        return $stmt->execute();
    }
    public function addTarea($nombre, $descripcion, $fecha_entrega) {
        $sql = "INSERT INTO tareas (nombre, descripcion, fecha_entrega) VALUES (?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sss", $nombre, $descripcion, $fecha_entrega);
        return $stmt->execute();
    }
    public function obtenerTareas() {
        $consulta = "SELECT * FROM tareas";
        return $this->con->consultar($consulta);
    }
    
    public function deleteUser($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateUser($id, $nombre, $correo, $rol, $imagen) {
        $sql = "UPDATE usuarios SET nombre_completo = ?, correo = ?, rol = ?, imagen = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssisi", $nombre, $correo, $rol, $imagen, $id);
        return $stmt->execute();
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}
?>






