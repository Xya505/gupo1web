<?php
require_once 'conexion.model.php';

class Tareas {
    private $conn;
    private $table = 'tareas';

    public function __construct() {
        $database = new Conexion();
        $this->conn = $database;
    }

    public function agregarTarea($curso_id, $nombre, $descripcion, $fecha_entrega, $archivo) {
        $query = "INSERT INTO " . $this->table . " (curso_id, nombre, descripcion, fecha_entrega, archivo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('issss', $curso_id, $nombre, $descripcion, $fecha_entrega, $archivo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function obtenerTareasPorCurso($curso_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE curso_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $curso_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>



