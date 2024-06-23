<?php
require_once 'conexion.model.php';

class Cursos {
    private $conn;
    private $table = 'cursos';

    public function __construct() {
        $database = new Conexion();
        $this->conn = $database->getConnection();
    }

    public function obtenerCursos() {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);

        if (!$result) {
            throw new \Exception("Error al obtener cursos: " . $this->conn->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerCursoPorId($curso_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $curso_id);

        if (!$stmt->execute()) {
            throw new \Exception("Error al obtener el curso por ID: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $curso = $result->fetch_assoc();

        if (!$curso) {
            throw new \Exception("No se encontró ningún curso con el ID proporcionado.");
        }

        return $curso;
    }

    public function agregarCurso($nombre, $descripcion, $profesor_id) {
        $query = "INSERT INTO " . $this->table . " (nombre, descripcion, profesor_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('ssi', $nombre, $descripcion, $profesor_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

?>

